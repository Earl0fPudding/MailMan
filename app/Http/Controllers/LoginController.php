<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Input;
use Session;
use App\Domain;
use App\User;
use DB;

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

    public function logout(Request $request) {
	Session::flush();
	return redirect(route('Login.showLogin'));
    }

    public function showStartPage(Request $request){
	return view('userstartpage');
    }

    public function signup(Request $request){
	$rules = ['captcha' => 'required|captcha'];
	$validator = validator()->make(request()->all(), $rules);
	if ($validator->fails()) { return redirect()->back(); }
	if(!Domain::findOrFail($request->domain_id)->registerable) { return redirect()->back(); }
	if($request->password!=$request->password_confirm) { return redirect()->back(); }

	$user = new User();
        $user->username = $request->username;
        $user->password = json_decode(json_encode(DB::select(DB::raw("SELECT ENCRYPT(:password, CONCAT('$6$', SUBSTRING(SHA(RAND()), -16))) as hash"), [ 'password' => $request->password ])), true)[0]['hash'];
        $user->domain_id = $request->domain_id;
        $user->save();

	return redirect(route('Login.showLogin'));
    }

    public function adminLogin(Request $request){
	if (Auth::guard('admin')->attempt($request->only('username', 'password'))) {
		return redirect(route('Admin.showDashboard'));
	} else { return redirect(route('Login.showAdminLogin')); }
    }

    public function login(Request $request) {
	// validate the given input
/*	$validator = Validator::make($request->all(), [
            'username' => 'required|max:45',
            'password' => 'required',
        ], getValidatorMessages());
	if ($validator->fails()) {
	    Session::flash('message', $validator->messages()->first());
            return redirect()->back()->withInput();
	}*/

	// try tp log in
	if (Auth::guard('mail')->attempt($request->only('username', 'password', 'domain_id'))) {
	   //$user = User::where('username', Input::post('username'))->first();
	    // set sesion variables
	    //Session::put('username', Input::post('username'));
	    //Session::put('role', $user->type);
		return redirect(route('Login.showStartPage'));
        } else {
	    return redirect(route('Login.showLogin'))->with('message', "WRONG LOGIN");
	}
    }
}
