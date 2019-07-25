<nav>
  <div class="nav-wrapper blue lighten-1">
    <a href="#!" class="brand-logo"><img class="responsive-img" style="height: auto;width: 60px;padding-top: 10px;margin-left: 15px;" src="{{asset('images/MailMan_Logo.svg')}}"></a>
    <a href="#" data-target="mobile-demo" class="sidenav-trigger" style="margin-top:10px;"><ion-icon name="menu" size="large"></ion-icon></a>
    <ul class="right hide-on-med-and-down">
     <?php if(auth()->guard('admin')->check()) { ?>
      <li><a href="{{route('Admin.showUsers')}}">Mail users</a></li>
      <li><a href="{{route('Admin.showAdmins')}}">Admins</a></li>
      <li><a href="{{route('Admin.showAliases')}}">Aliases</a></li>
      <li><a href="{{route('Admin.showInvites')}}">Invites</a></li>
     <?php } else if(auth()->guard('mail')->check()) { ?>
      <li>...</li>
     <?php } ?>
    </ul>
  </div>
</nav>

<ul class="sidenav" id="mobile-demo">
    <?php if(auth()->guard('admin')->check()) { ?>
      <li><a href="{{route('Admin.showUsers')}}">Mail users</a></li>
      <li><a href="{{route('Admin.showAdmins')}}">Admins</a></li>
      <li><a href="{{route('Admin.showAliases')}}">Aliases</a></li>
      <li><a href="{{route('Admin.showInvites')}}">Invites</a></li>
     <?php } else if(auth()->guard('mail')->check()) { ?>
      <li>...</li>
     <?php } ?>
</ul>

<script>
$(document).ready(function(){
    $('.sidenav').sidenav();
});
</script>
