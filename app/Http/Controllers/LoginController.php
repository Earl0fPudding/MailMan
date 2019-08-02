<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Input;
use Session;
use App\Domain;
use App\User;
use DB;
use App\ForbiddenUsername;
use App\Invite;
use Validator;
use Illuminate\Validation\Rule;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('redirectIfLoggedIn')->only(['showLogin', 'showAdminLogin']);
    }

    public function showLogin(Request $request) {
	$domains = Domain::all();
	$registerable_domains = Domain::where('registerable', true)->get();
        return view('login', [ 'domains' => $domains, 'registerable_domains' => $registerable_domains ]);
    }

    public function showAdminLogin(Request $request){
	return view('adminlogin');
    }

    public function showAbout(Request $request){
	return view('about');
    }

    public function logout(Request $request) {
	Session::flush();
	return redirect(route('Login.showLogin'))->withSuccess(get_message('succ-logout'));
    }

    public function processInvite(Request $request){
	if(Invite::where('token', $request->token)->count() == 0) { return redirect(route('Login.showLogin'))->withErrors(get_message('err-invite-invalid')); }
	$invite = Invite::where('token', $request->token)->with('domain')->first();
	if($invite->termination_date<date("Y-m-d H:i:s")) { return redirect(route('Login.showLogin'))->withErrors(get_message('err-invite-expired')); }
	session()->put('name_preset', $invite->name_preset);
	session()->put('domain_id', $invite->domain_id);
	session()->put('domain_name', $invite->domain->name);
	session()->put('invite_token', $invite->token);
//	$invite->delete();

	return view('invitesignup');
    }

    public function invitesignup(Request $request){
	$validator = Validator::make($request->all(), [
            'username' => 'max:50',
            'password' => 'required|same:password_confirm',
            'password_confirm' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
	if(Invite::where('token', session('token'))->count() == 0){ return redirect(route('Login.showLogin'))->withErrors(get_message('err-invite-expired')); }
	Invite::where('token', session('token'))->delete();
	$user = new User();
	if(session('name_preset')!==null){
	    $user->username = session('name_preset');
	} else {
	    if(ForbiddenUsername::where('username', 'like', '%'.$request->username.'%')->count() > 0) {
		return redirect()->back()->withErrors(get_message('err-forbidden-username'))->withInput();
	    }
	    if(User::where(['username' => $request->username, 'domain_id' => session('domain_id')])->count() > 0) {
            return redirect()->back()->withErrors(get_message('err-username-exists'))->withInput();
        }
	    $user->username = $request->username;
	}
	$user->password = sha512_make($request->password);
	$user->domain_id = session('domain_id');
	$user->save();

	Session::flush();
	return redirect(route('Login.showLogin'))->withSuccess(get_message('succ-signup'));
    }

    public function signup(Request $request){
	$validator = Validator::make($request->all(), [
            'username_signup' => 'required|max:50',
            'domain_id_signup' => 'required|integer',
            'password_signup' => 'required|same:password_confirm',
	    'password_confirm' => 'required',
	    'captcha' => 'required|captcha'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
	if(User::where(['username' => $request->username_signup, 'domain_id' => $request->domain_id_signup])->count() > 0) {
	    return redirect()->back()->withErrors(get_message('err-username-exists'))->withInput();
	}
	if(ForbiddenUsername::where('username', 'like', '%'.$request->username_signup.'%')->count() > 0) {
	    return redirect()->back()->withErrors(get_message('err-forbidden-username'))->withInput();
	}
	if(!Domain::findOrFail($request->domain_id_signup)->registerable) {
	    return redirect()->back()->withErrors(get_message('err-domain-registerable'))->withInput();
	}

	$user = new User();
        $user->username = $request->username_signup;
        $user->password = sha512_make($request->password_signup);
        $user->domain_id = $request->domain_id_signup;
        $user->save();

	Session::flush();
	return redirect(route('Login.showLogin'))->withSuccess(get_message('succ-signup'));
    }

    public function adminLogin(Request $request){
	$validator = Validator::make($request->all(), [
            'username' => 'required|max:50',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
	if (Auth::guard('admin')->attempt($request->only('username', 'password'))) {
		return redirect(route('Admin.showDashboard'))->withSuccess(get_message('succ-login'));
	} else { return redirect(route('Login.showAdminLogin'))->withErrors(get_message('err-login'))->withInput(); }
    }

    public function login(Request $request) {
	// validate the given input
	$validator = Validator::make($request->all(), [
            'username' => 'required|max:50',
	    'domain_id' => 'required|integer',
            'password' => 'required',
        ]);
	if ($validator->fails()) {
	    return redirect()->back()->withErrors($validator)->withInput();
	}

	// try to log in
	if (Auth::guard('mail')->attempt($request->only('username', 'password', 'domain_id'))) {
		return redirect(route('User.showDashboard'))->withSuccess(get_message('succ-login'));
        } else {
	    return redirect(route('Login.showLogin'))->withErrors(get_message('err-login'))->withInput();
	}
    }
}
