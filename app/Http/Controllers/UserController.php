<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Hash;

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
        $loggedin_user = Auth::guard('mail')->user();
        if($request->password == $request->password_confirm){
            if(Hash::check($request->old_password, $loggedin_user->password)){
                $loggedin_user->password = sha512_make($request->password);
                $loggedin_user->save();
            }
        }
        return redirect()->back();
    }
}
