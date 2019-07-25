<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
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
	$users = User::with(['domain'])->get();
	$domains = Domain::all();
	return view('showusers', [ 'users' => $users, 'domains' => $domains ]);
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

// --- DOMAIN ---

    public function addDomain(Request $request){
	$domain = new Domain();
	$domain->name = $request->name;
	$domain->registerable = isset($request->registerable);
	$domain->save();

	return redirect(route('Admin.showDomains'));
    }

    public function updateDomain(Request $request){
	$domain = Domain::findOrFail($request->id);
	$domain->registerable = $request->registerable;
	$domain->save();

	return redirect(route('Admin.showDomains'));
    }

    public function deleteDomain(Request $request){
	Domain::destroy($request->id);

	return redirect(route('Admin.showDomains'));
    }

// --- USER ---

    public function addUser(Request $request){
	if($request->password != $request->password_confirm) { return redirect(route('Admin.showUsers')); }
        DB::table('users')->insert([
		'username' => $request->username,
		'password' => DB::raw("ENCRYPT('".$request->password."', CONCAT('$6$', SUBSTRING(SHA(RAND()), -16)))"),
		'domain_id' => $request->domain_id
	]);
//        $user->domain_id = $request->domain_id;
  //      $user->save();

        return redirect(route('Admin.showUsers'));
    }

    public function updateUser(Request $request){
	if($request->password != $request->password_confirm) { return redirect(route('Admin.showUsers')); }
        $user = User::findOrFail($request->id);
        $user->password = DB::raw("SELECT ENCRYPT(:password, CONCAT('$6$', SUBSTRING(SHA(RAND()), -16)))", [ 'password' => $request->password ]);
        $user->save();

        return redirect(route('Admin.showUsers'));
    }

    public function deleteUser(Request $request){
        User::destroy($request->id);

        return redirect(route('Admin.showUsers'));
    }
}
