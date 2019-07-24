<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>MailMan - Login</title>
@include('headdata')
    </head>
    <body>
@include('cookieConsent::index')
    <main style="margin-top:10vh;">
        <div class="container">
	    <div class="row">
	        <div class="col s6 offset-s3 m2 center offset-m5">
                    <img class="responsive-img" src="{{asset('images/MailMan_Logo.svg')}}">
                </div>
            </div>
            <div class="row">
                <div class="col m6 offset-m3 center">
                    <h4 class="blue-text darken-2" style="margin-top:-5px;">MailMan</h4>
                    <h6>The simple and secure account managing application for your mailserver.</h6>
                </div>
            </div>
            <div class="row">
                <div class="col s12 m6 offset-m3 center-align">
                    <div class="card">
                        <div class="card-content">
                            <!-- <center><span class="card-title black-text">Login</span></center> -->
                            <form method="post" action="{{route('Login.login')}}">
                                @csrf
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input type="email" class="validate" name="mail" id="m_id" required autofocus>
                                        <label for="m_id">Mail address</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input name="password" id="p_id" type="password" class="validate" required>
                                        <label for="p_id">Password</label>
                                    </div>
                                </div>
                                <button class="btn waves-effect waves-light blue darken-2" type="submit" name="action" id="b_submit">Log in</button>
                            </form>
                            <div class="divider" style="margin-top:15px;"></div>
                            <p class="grey-text darken-4" style="margin-top:5px;margin-bottom:-15px;">If you don't have an account you can <a href="#signup-modal" class="modal-trigger">sign up here</a>.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@include('footer')
<div id="signup-modal" class="modal">
    <div class="modal-content">
      <form method="post" action="#">
      <h4>Sign up a new mail account</h4>
	<div class="container">
        @csrf
      <div class="row">
          <div class="input-field col m6 s12">
              <input name="username" id="u_id" type="text" class="validate" required>
              <label for="u_id">Username</label>
          </div>
          <div class="col m1 valign-wrapper s2">
              <h5>@</h5>
          </div>
          <div class="input-field col m5 s10">
              <select id="d_id">
                  <option value="" disabled selected>Choose the domain</option>
                  <option value="1">Option 1</option>
                  <option value="2">Option 2</option>
                  <option value="3">Option 3</option>
              </select>
              <label for="d_id">Domain</label>
          </div>
      </div>
      <div class="row">
          <div class="input-field col m12">
              <input name="password" id="p_id" type="password" class="validate" required>
              <label for="p_id">Password</label>
          </div>
      </div>
      <div class="row">
          <div class="input-field col m12">
              <input name="password_confirm" id="pc_id" type="password" class="validate" required>
              <label for="pc_id">Confirm password</label>
          </div>
      </div>
      <div class="row">
          <div class="col m3">
              {!! captcha_img() !!}
          </div>
          <div class="col m1">
              <a href="#!" id="refreshCaptcha"><ion-icon name="refresh-circle" size="large"></ion-icon></a>
          </div>
      <div>
      <div class="row">
          <div class="input-field col m12">
              <input name="captcha" id="c_id" type="text" class="validate" required>
              <label for="c_id">Captcha</label>
          </div>
      </div>
    </div></div>
    <div class="modal-footer" style="text-align:center;">
      <button type="submit" class="waves-effect waves-light blue darken-2 btn">Sign up</button>
    </div>
    </form>
  </div>
<script type="text/javascript">
$(document).ready(function(){
    $('.modal').modal();
    $('select').formSelect();
  });

$('#refreshCaptcha').on('click', function(e){
    e.preventDefault();
    $.ajax({
        type: "GET",
        url: '/refreshCaptcha',
    }).done(function( msg ) {
	const x = document.getElementsByTagName("img");
	for (let e of x) { if(e.src.includes("captcha")) { e.src = msg; } }
    });
});
</script>
    </body>
</html>
