<nav>
  <div class="nav-wrapper blue lighten-1">
    <a href="#!" class="brand-logo"><img class="responsive-img" style="height: auto;width: 60px;padding-top: 10px;margin-left: 15px; /*height: auto;width: 65px; padding-top: 12%;  margin-left: 15px;*/" src="{{asset('images/MailMan_Logo_white.svg')}}"></a>
    <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
    <ul class="right hide-on-med-and-down">
     @if(auth()->guard('admin')->check())
      <li><a class="dropdown-trigger" href="#!" data-target="mail-dropdown"><i class="material-icons left">email</i>Mail management<i class="material-icons right">arrow_drop_down</i></a></li>
      <li><a href="{{route('Admin.showDomains')}}"><i class="material-icons left">language</i>Domains</a></li>
      <li><a href="{{route('Admin.showForbiddenUsernames')}}"><i class="material-icons left">pan_tool</i>Username blacklist</a></li>
      <li><a href="{{route('Admin.showAdmins')}}"><i class="material-icons left">people</i>Admins</a></li>
      <li><a class="dropdown-trigger" href="#!" data-target="user-dropdown"><i class="material-icons left">person</i>{{ Auth::guard('admin')->user()->username }}<i class="material-icons right">arrow_drop_down</i></a></li>
     @endif
     @if(auth()->guard('mail')->check())
      <li><a class="dropdown-trigger" href="#!" data-target="user-dropdown"><i class="material-icons left">person</i>{{ Auth::guard('mail')->user()->username.'@'.Auth::guard('mail')->user()->domain->name }}<i class="material-icons right">arrow_drop_down</i></a></li>
     @endif
    </ul>
  </div>
</nav>

<ul class="sidenav" id="mobile-demo">
      <li class="logo center">
        <a id="logo-container" href="/" class="brand-logo">
            <img style="height: auto; width: 55px; margin-top: 15px;" src="{{ asset('images/MailMan_Logo.svg') }}">
        </a>
      </li>
      <li class="center blue-text lighten-1"><h5>MailMan</h5></li>
    @if(auth()->guard('admin')->check())
      <li><a href="#!"><i class="material-icons">email</i>Mail management<i class="material-icons right">arrow_drop_down</i></a></li>
      <li class="subnav-item"><a href="{{route('Admin.showUsers')}}"><i class="material-icons left">contact_mail</i>Mail users</a></li>
      <li class="subnav-item"><a href="{{route('Admin.showAliases')}}"><i class="material-icons left">compare_arrows</i>Aliases</a></li>
      <li class="subnav-item"><a href="{{route('Admin.showInvites')}}"><i class="material-icons left">person_add</i>Invites</a></li>
      <li><a href="{{route('Admin.showDomains')}}"><i class="material-icons left">language</i>Domains</a></li>
      <li><a href="{{route('Admin.showForbiddenUsernames')}}"><i class="material-icons left">pan_tool</i>Username blacklist</a></li>
      <li><a href="{{route('Admin.showAdmins')}}"><i class="material-icons left">people</i>Admins</a></li>
      <li><a href="#!"><i class="material-icons left">person</i>{{ Auth::guard('admin')->user()->username }}<i class="material-icons right">arrow_drop_down</i></a></li>
      <li class="subnav-item"><a href="#change-password-modal" class="modal-trigger"><i class="material-icons left">edit</i>Change password</a></li>
      <li class="subnav-item"><a href="{{ route('Login.logout') }}"><i class="material-icons left">exit_to_app</i>Log out</a></li>
     @endif
     @if(auth()->guard('mail')->check())
      <li><a href="#!"><i class="material-icons left">person</i>{{ Auth::guard('mail')->user()->username.'@'.Auth::guard('mail')->user()->domain->name }}<i class="material-icons right">arrow_drop_down</i></a></li>
      <li class="subnav-item"><a href="#change-password-modal" class="modal-trigger"><i class="material-icons left">edit</i>Change password</a></li>
      <li class="subnav-item"><a href="{{ route('Login.logout') }}"><i class="material-icons left">exit_to_app</i>Log out</a></li>
     @endif
</ul>

<ul id="mail-dropdown" class="dropdown-content">
	<li><a href="{{route('Admin.showUsers')}}"><i class="material-icons left">contact_mail</i>Mail users</a></li>
	<li><a href="{{route('Admin.showAliases')}}"><i class="material-icons left">compare_arrows</i>Aliases</a></li>
	<li><a href="{{route('Admin.showInvites')}}"><i class="material-icons left">person_add</i>Invites</a></li>
</ul>

<ul id="user-dropdown" class="dropdown-content">
  <li><a href="#change-password-modal" class="modal-trigger"><i class="material-icons left">edit</i>Change password</a></li>
  <li><a href="{{ route('Login.logout') }}"><i class="material-icons left">exit_to_app</i>Log out</a></li>
</ul>

  <div id="change-password-modal" class="modal">
    @if(auth()->guard('admin')->check())
    <form method="post" action="{{route('Admin.changePassword')}}">
    @endif
    @if(auth()->guard('mail')->check())
    <form method="post" action="{{route('User.changePassword')}}">
    @endif
      <div class="modal-content">
        <h4>Change your password</h4>
        @csrf
        <div class="contrainer">
          <div class="row">
            <div class="input-field col m12">
	      <i class="material-icons prefix">fingerprint</i>
              <input name="old_password" placeholder="Old password" id="op_id_cp" type="password" class="validate" required>
              <label for="op_id_cp">Old password</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col m12">
	      <i class="material-icons prefix">fingerprint</i>
              <input name="password_cp" placeholder="New password" id="p_id_cp" type="password" class="validate" required>
              <label for="p_id_cp">New password</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col m12">
	      <i class="material-icons prefix">fingerprint</i>
              <input name="password_confirm_cp" id="pc_id_cp" placeholder="Confirm new password" type="password" class="validate" required>
              <label for="pc_id_cp">Confirm new password</label>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer" style="text-align:center;">
        <button type="submit" href="#!" class="waves-effect waves-light btn blue darken-2">Change password</button>
      </div>
    </form>
  </div>

<script>
$(document).ready(function(){
    $('.sidenav').sidenav();
    $(".dropdown-trigger").dropdown({coverTrigger: false, constrainWidth: false, alignment: 'right', hover: false});
    $('.modal').modal();
    @if(old('password_cp'))
    $('#change-password-modal').modal('open');
    @endif
});
</script>
