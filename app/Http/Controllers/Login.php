<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Input;

class Login extends Controller
{
    public function showLogin(Request $request) {
        return view('login');
    }
    public function logout(Request $request) {
	Session::flush();
	return redirect(route('Login.showLogin'));
    }

    public function showStartPage(Request $request){
	return view('welcome');
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
	if (Auth::attempt(['email' => Input::post('mail'), 'password' => Input::post('password')])) {
	   //$user = User::where('username', Input::post('username'))->first();
	    // set sesion variables
	    //Session::put('username', Input::post('username'));
	    //Session::put('role', $user->type);
            //redirectToUserSpecificPage($request);

	    // redirect to specific user page with info message
	    /*if(Session::get('role') == 0) {
                return redirect(route('User.showStartPage'))->with('message', getStatusMessageByCode(101));
            }
            if(Session::get('role') == 1) {
                return redirect(route('Admin.showStartPage'))->with('message', getStatusMessageByCode(101));
            }*/
		return redirect(route('Login.showStartPage'));
        } else {
	    return redirect(route('Login.showLogin'))->with('message', "WRONG LOGIN");
	}
    }
}
