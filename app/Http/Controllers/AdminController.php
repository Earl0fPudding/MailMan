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
use App\ForbiddenUsername;
use Validator;

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

    public function showForbiddenUsernames(Request $request){
	$forbidden_usernames = ForbiddenUsername::all();
	return view('showusernameblacklist', ['forbidden_usernames' => $forbidden_usernames]);
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
	$validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'password_cp' => 'required|same:password_confirm_cp',
            'password_confirm_cp' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
	$loggedin_user = Auth::guard('admin')->user();
	if(Hash::check($request->old_password, $loggedin_user->password)){
	    $loggedin_user->password = Hash::make($request->password);
	    $loggedin_user->save();
	} else {
	    return redirect()->back()->withErrors(get_message('err-pw-change-old'))->withInput();
	}
	return redirect()->back()->withSuccess(get_message('succ-pw-change'));
    }

// --- DOMAIN ---

    public function addDomain(Request $request){
	$validator = Validator::make($request->all(), [
            'name_add' => 'required|max:70|unique:domains,name',
	    'registerable_add' => 'integer'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

	$domain = new Domain();
	$domain->name = $request->name_add;
	$domain->registerable = isset($request->registerable_add);
	$domain->save();

	return redirect(route('Admin.showDomains'))->withSuccess(get_message('succ-create'));
    }

    public function updateDomain(Request $request){
	$validator = Validator::make($request->all(), [
            'registerable_update' => 'integer',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
	$domain = Domain::findOrFail($request->id);
	$domain->registerable = $request->registerable_update;
	$domain->save();

	return redirect(route('Admin.showDomains'))->withSuccess(get_message('succ-update'));
    }

    public function deleteDomain(Request $request){
	Domain::destroy($request->id);

	return redirect(route('Admin.showDomains'))->withSuccess(get_message('succ-delete'));
    }

// --- USER ---

    public function addUser(Request $request){
	$validator = Validator::make($request->all(), [
            'username' => 'required|max:50',
            'password' => 'required|same:password_confirm',
	    'password_confirm' => 'required',
	    'domain_id' => 'required|integer'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
	if(User::where(['username' => $request->username, 'domain_id' => session('domain_id')])->count() > 0) {
            return redirect()->back()->withErrors(get_message('err-username-exists'))->withInput();
        }

	$user = new User();
	$user->username = $request->username;
	$user->password = sha512_make($request->password);
        $user->domain_id = $request->domain_id;
        $user->save();

        return redirect(route('Admin.showUsers'))->withSuccess(get_message('succ-create'));
    }

    public function updateUser(Request $request){
	$validator = Validator::make($request->all(), [
            'password_update' => 'required|same:password_confirm_update',
            'password_confirm_update' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

	$user = User::findOrFail($request->id);
	$user->password = sha512_make($request->password_update);
        $user->save();

        return redirect(route('Admin.showUsers'))->withSuccess(get_message('succ-update'));
    }

    public function deleteUser(Request $request){
        User::destroy($request->id);

        return redirect(route('Admin.showUsers'))->withSuccess(get_message('succ-delete'));
    }

// --- ADMIN ---

    public function addAdmin(Request $request){
	$validator = Validator::make($request->all(), [
            'username_add' => 'required|max:50|unique:admins,username',
            'password_add' => 'required|same:password_confirm_add',
            'password_confirm_add' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $admin = new Admin();
        $admin->username = $request->username_add;
        $admin->password = Hash::make($request->password_add);
        $admin->save();

        return redirect(route('Admin.showAdmins'))->withSuccess(get_message('succ-create'));
    }

    public function updateAdmin(Request $request){
	$validator = Validator::make($request->all(), [
            'password_update' => 'required|same:password_confirm_update',
            'password_confirm_update' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

	$admin = Admin::findOrFail($request->id);
        $admin->password = Hash::make($request->password_update);
        $admin->save();

        return redirect(route('Admin.showAdmins'))->withSuccess(get_message('succ-update'));
    }

    public function deleteAdmin(Request $request){
	if(Admin::count() == 1) { return redirect()->back()->withErrors(get_message('err-last-admin')); }
        Admin::destroy($request->id);

        return redirect(route('Admin.showAdmins'))->withSuccess(get_message('succ-delete'));
    }

// --- ALIAS ---

    public function addAlias(Request $request){
	$validator = Validator::make($request->all(), [
            'username_add' => 'required|max:50',
            'domain_id_add' => 'required|integer',
            'user_id_add' => 'required|integer',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $alias = new Alias();
        $alias->source_username = $request->username_add;
        $alias->source_domain_id = $request->domain_id_add;
	$alias->destination_user_id = $request->user_id_add;
        $alias->save();

        return redirect(route('Admin.showAliases'))->withSuccess(get_message('succ-create'));
    }

    public function updateAlias(Request $request){
	$validator = Validator::make($request->all(), [
            'user_id_update' => 'required|integer',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $alias = Alias::findOrFail($request->id);
        $alias->destination_user_id = $request->user_id_update;
        $alias->save();

        return redirect(route('Admin.showAliases'))->withSuccess(get_message('succ-update'));
    }

    public function deleteAlias(Request $request){
        Alias::destroy($request->id);

        return redirect(route('Admin.showAliases'))->withSuccess(get_message('succ-delete'));
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

// --- FORBIDDEN USERNAMES ---

    public function addForbiddenUsername(Request $request){
        $forbiddenusername = new ForbiddenUsername();
	$forbiddenusername->username = $request->username;
        $forbiddenusername->save();

        return redirect(route('Admin.showForbiddenUsernames'));
    }

    public function deleteForbiddenUsername(Request $request){
        ForbiddenUsername::destroy($request->id);

        return redirect(route('Admin.showForbiddenUsernames'));
    }
}
