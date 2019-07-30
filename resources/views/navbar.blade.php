<nav>
  <div class="nav-wrapper blue lighten-1">
    <a href="#!" class="brand-logo"><img class="responsive-img" style="height: auto;width: 60px;padding-top: 10px;margin-left: 15px;" src="{{asset('images/MailMan_Logo.svg')}}"></a>
    <a href="#" data-target="mobile-demo" class="sidenav-trigger" style="margin-top:10px;"><ion-icon name="menu" size="large"></ion-icon></a>
    <ul class="right hide-on-med-and-down">
     @if(auth()->guard('admin')->check())
      <li><a href="{{route('Admin.showUsers')}}">Mail users</a></li>
      <li><a href="{{route('Admin.showAdmins')}}">Admins</a></li>
      <li><a href="{{route('Admin.showDomains')}}">Domains</a></li>
      <li><a href="{{route('Admin.showAliases')}}">Aliases</a></li>
      <li><a href="{{route('Admin.showInvites')}}">Invites</a></li>
      <li><a href="{{route('Admin.showForbiddenUsernames')}}">Username blacklist</a></li>
      <li><a class="dropdown-trigger" href="#!" data-target="user-dropdown">{{ Auth::guard('admin')->user()->username }}<ion-icon name="arrow-dropdown"></ion-icon></a></li>
     @endif
     @if(auth()->guard('mail')->check())
      <li><a class="dropdown-trigger" href="#!" data-target="user-dropdown">{{ Auth::guard('mail')->user()->username.'@'.Auth::guard('mail')->user()->domain->name }}<ion-icon name="arrow-dropdown"></ion-icon></a></li>
     @endif
    </ul>
  </div>
</nav>

<ul class="sidenav" id="mobile-demo">
      <li class="logo center">
        <a id="logo-container" href="/" class="brand-logo">
            <img style="height: auto; width: 55px;" src="{{ asset('images/MailMan_Logo.svg') }}">
        </a>
      </li>
    @if(auth()->guard('admin')->check())
      <li><a href="{{route('Admin.showUsers')}}">Mail users</a></li>
      <li><a href="{{route('Admin.showAdmins')}}">Admins</a></li>
      <li><a href="{{route('Admin.showDomains')}}">Domains</a></li>
      <li><a href="{{route('Admin.showAliases')}}">Aliases</a></li>
      <li><a href="{{route('Admin.showInvites')}}">Invites</a></li>
      <li><a href="{{route('Admin.showForbiddenUsernames')}}">Username blacklist</a></li>
      <div class="divider"></div>
      <li><a href="#change-password-modal" class="modal-trigger">Change password</a></li>
      <li><a href="{{ route('Login.logout') }}">Log out</a></li>
     @endif
     @if(auth()->guard('mail')->check())
        <li><a href="#change-password-modal" class="modal-trigger">Change password</a></li>
        <li><a href="{{ route('Login.logout') }}">Log out</a></li>
     @endif
</ul>

<ul id="user-dropdown" class="dropdown-content">
  <li><a href="#change-password-modal" class="modal-trigger">Change password</a></li>
  <li><a href="{{ route('Login.logout') }}">Log out</a></li>
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
              <input name="old_password" placeholder="Old password" id="op_id_cp" type="password" class="validate" required>
              <label for="op_id_cp">Old password</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col m12">
              <input name="password_cp" placeholder="New password" id="p_id_cp" type="password" class="validate" required>
              <label for="p_id_cp">New password</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col m12">
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
    $(".dropdown-trigger").dropdown();
    $('.modal').modal();
    @if(old('password_cp'))
    $('#change-password-modal').modal('open');
    @endif
});
</script>
