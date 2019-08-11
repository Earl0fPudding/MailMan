<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Hash;
use Validator;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkUser');
    }

    public function showDashboard(Request $request){
	return view('userdashboard');
    }

    public function changePassword(Request $request){
	$validator = Validator::make($request->all(), [
	    'old_password' => 'required',
            'password_cp' => 'required|same:password_confirm_cp',
	    'password_confirm_cp' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $loggedin_user = Auth::guard('mail')->user();
        if(Hash::check($request->old_password, $loggedin_user->password)){
            $loggedin_user->password = sha512_make($request->password_cp);
            $loggedin_user->save();
        } else {
	    return redirect()->back()->withErrors(get_message('err-pw-change-old'))->withInput();
	}
        return redirect()->back()->withSuccess(get_message('succ-pw-change'));
    }
}
