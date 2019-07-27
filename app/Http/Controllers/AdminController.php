<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\User;
use App\Domain;
use App\Admin;
use Hash;
use App\Alias;
use App\Invite;

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
	$admins = Admin::all();
	return view('showadmins', [ 'admins' => $admins ]);
    }

    public function showAliases(Request $request){
	$aliases = Alias::with(['domain', 'user'])->get();
	$users = User::with([ 'domain' ])->get();
	$domains = Domain::all();
	return view('showaliases', [ 'aliases' => $aliases, 'users' => $users, 'domains' => $domains ]);
    }

    public function showInvites(Request $request){
	$invites = Invite::with('domain')->get();
	$domains = Domain::all();
	return view('showinvites', [ 'invites' => $invites, 'domains' => $domains ]);
    }

    public function changePassword(Request $request){
	$loggedin_user = Auth::guard('admin')->user();
	if($request->password == $request->password_confirm){
	    if(Hash::check($request->old_password, $loggedin_user->password)){
		$loggedin_user->password = Hash::make($request->password);
		$loggedin_user->save();
	    }
	}
	return redirect()->back();
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
	$user = new User();
	$user->username = $request->username;
	$user->password = json_decode(json_encode(DB::select(DB::raw("SELECT ENCRYPT(:password, CONCAT('$6$', SUBSTRING(SHA(RAND()), -16))) as hash"), [ 'password' => $request->password ])), true)[0]['hash'];
        $user->domain_id = $request->domain_id;
        $user->save();

        return redirect(route('Admin.showUsers'));
    }

    public function updateUser(Request $request){
	if($request->password != $request->password_confirm) { return redirect(route('Admin.showUsers')); }
        $user = User::findOrFail($request->id);
	$user->password = json_decode(json_encode(DB::select(DB::raw("SELECT ENCRYPT(:password, CONCAT('$6$', SUBSTRING(SHA(RAND()), -16))) as hash"), [ 'password' => $request->password ])), true)[0]['hash'];
        $user->save();

        return redirect(route('Admin.showUsers'));
    }

    public function deleteUser(Request $request){
        User::destroy($request->id);

        return redirect(route('Admin.showUsers'));
    }

// --- ADMIN ---

    public function addAdmin(Request $request){
	if($request->password != $request->password_confirm) { return redirect(route('Admin.showAdmins')); }
        $admin = new Admin();
        $admin->username = $request->username;
        $admin->password = Hash::make($request->password);
        $admin->save();

        return redirect(route('Admin.showAdmins'));
    }

    public function updateAdmin(Request $request){
        if($request->password != $request->password_confirm) { return redirect(route('Admin.showAdmins')); }
	$admin = Admin::findOrFail($request->id);
        $admin->password = Hash::make($request->password);
        $admin->save();

        return redirect(route('Admin.showAdmins'));
    }

    public function deleteAdmin(Request $request){
        Admin::destroy($request->id);

        return redirect(route('Admin.showAdmins'));
    }

// --- ALIAS ---

    public function addAlias(Request $request){
        $alias = new Alias();
        $alias->source_username = $request->username;
        $alias->source_domain_id = $request->domain_id;
	$alias->destination_user_id = $request->user_id;
        $alias->save();

        return redirect(route('Admin.showAliases'));
    }

    public function updateAlias(Request $request){
        $alias = Alias::findOrFail($request->id);
        $alias->destination_user_id = $request->user_id;
        $alias->save();

        return redirect(route('Admin.showAliases'));
    }

    public function deleteAlias(Request $request){
        Alias::destroy($request->id);

        return redirect(route('Admin.showAliases'));
    }

// --- INVITE ---

    public function addInvite(Request $request){
        $invite = new Invite();
	do {
        $invite->token = str_replace('.', '0', str_replace('/', '0', substr(Hash::make('Lelouch'), 7, -3)));
	} while(Invite::where('token', $invite->token)->count()>0);
        if(isset($request->name_preset)){
	    $invite->name_preset = $request->name_preset;
	}
        $invite->termination_date = $request->termination_date.' '.$request->termiantion_time;
	$invite->domain_id = $request->domain_id;
        $invite->save();

        return redirect(route('Admin.showInvites'));
    }

    public function updateInvite(Request $request){
        $invite = Invite::findOrFail($request->id);
        // not needed yet
        $invite->save();

        return redirect(route('Admin.showInvites'));
    }

    public function deleteInvite(Request $request){
        Invite::destroy($request->id);

        return redirect(route('Admin.showInvites'));
    }
}
