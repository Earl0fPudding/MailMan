<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Domain;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkAdmin');
    }

    public function showDashboard(Request $request){
	return view('admindashboard');
    }

    public function showDomains(Request $request){
	$domains = Domain::all();
	return view('showdomains', [ 'domains' => $domains ]);
    }

    public function showUsers(Request $request){
	$users=User::all();
	return view('showusers', [ 'users' => $users ]);
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
