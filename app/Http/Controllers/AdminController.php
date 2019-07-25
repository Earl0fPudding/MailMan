<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkAdmin');
    }

    public function showDashboard(Request $request){
	return view('admindashboard');
    }

    public function showUsers(Request $request){
	return view('showusers');
    }

    public function showAdmins(Request $request){
	return view('showadmins');
    }

    public function showAliases(Request $request){
	return view('showaliases');
    }

    public function showInvites(Request $request){
	return view('showinvites');
    }
}
