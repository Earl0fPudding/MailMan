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
	return redirect(route('Login.showLogin'));
    }

    public function processInvite(Request $request){
	$invite = Invite::where('token', $request->token)->with('domain')->first();
	if($invite->termination_date<date("Y-m-d H:i:s")) { return redirect(route('Login.showLogin')); }
	session()->put('name_preset', $invite->name_preset);
	session()->put('domain_id', $invite->domain_id);
	session()->put('domain_name', $invite->domain->name);
	$invite->delete();

	return view('invitesignup');
    }

    public function invitesignup(Request $request){
	if($request->password!=$request->password_confirm) { return redirect(route('Login.logout')); }
	$user = new User();
	if(session('name_preset')!==null){
	    $user->username = session('name_preset');
	} else {
	    if(ForbiddenUsername::where('username', 'like', '%'.$request->username.'%')->count() > 0) { return redirect(route('Login.logout')); }
	    $user->username = $request->username;
	}
	$user->password = sha512_make($request->password);
	$user->domain_id = session('domain_id');
	$user->save();

	return redirect(route('Login.logout'));
    }

    public function signup(Request $request){
	$rules = ['captcha' => 'required|captcha'];
	$validator = validator()->make(request()->all(), $rules);
	if ($validator->fails()) { return redirect()->back(); }
	if(ForbiddenUsername::where('username', 'like', '%'.$request->username.'%')->count() > 0) { return redirect()->back(); }
	if(!Domain::findOrFail($request->domain_id)->registerable) { return redirect()->back(); }
	if($request->password!=$request->password_confirm) { return redirect()->back(); }

	$user = new User();
        $user->username = $request->username;
        $user->password = sha512_make($request->password);
        $user->domain_id = $request->domain_id;
        $user->save();

	return redirect(route('Login.showLogin'));
    }

    public function adminLogin(Request $request){
	if (Auth::guard('admin')->attempt($request->only('username', 'password'))) {
		return redirect(route('Admin.showDashboard'))->with('success', "Logged in!");
	} else { return redirect(route('Login.showAdminLogin')); }
    }

    public function login(Request $request) {
	// validate the given input
	$validator = Validator::make($request->all(), [
            'username' => 'required|max:50',
	    'domain_id' => 'required|integer',
            'password' => 'required',
        ]);
	if ($validator->fails()) {
//	    Session::flash('message', $validator->messages()->first());
	return redirect()->back()->withErrors($validator)->withInput();
	}

	// try tp log in
	if (Auth::guard('mail')->attempt($request->only('username', 'password', 'domain_id'))) {
	   //$user = User::where('username', Input::post('username'))->first();
	    // set sesion variables
	    //Session::put('username', Input::post('username'));
	    //Session::put('role', $user->type);
		return redirect(route('User.showDashboard'));
        } else {
	    return redirect(route('Login.showLogin'))->with('message', "WRONG LOGIN");
	}
    }
}
