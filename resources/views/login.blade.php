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
                <div class="col s12 m6 offset-m3">
                    <div class="card">
                        <div class="card-content">
                            <!-- <center><span class="card-title black-text">Login</span></center> -->
                            <form method="post" action="{{route('Login.login')}}">
                                @csrf
                                <div class="row">
                                    <div class="input-field col m6 s12">
					<i class="material-icons prefix">person</i>
              				<input name="username" value="{{ old('username') }}" id="u_id" type="text" class="validate @error('username') invalid @enderror" required autofocus>
              				<label for="u_id">Username</label>
          			    </div>
          			    <!-- <div class="col m1 s1 offset-s1">
              				<h5 class="right"><b>@</b></h5>
          			    </div> -->
          			    <div class="input-field col m6 s12">
					<i class="material-icons prefix">@</i>
              				<select id="d_id" name="domain_id" class="@error('domain_id') invalid @enderror" required>
             				     @if(sizeof($domains)==0) <option value="" disabled selected>No domains available</option> @endif
             				     @foreach($domains as $domain)
					     <option value="{{ $domain->id }}" @if(old('domain_id')==$domain->id) selected @endif>{{ $domain->name }}</option>
					     @endforeach
             				</select>
              				<label for="d_id">Domain</label>
          			    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
					<i class="material-icons prefix">fingerprint</i>
                                        <input name="password" id="p_id" type="password" class="validate @error('password') invalid @enderror" required>
                                        <label for="p_id">Password</label>
                                    </div>
                                </div>
				<div class="row" style="text-align:center;">
                                <button class="btn waves-effect waves-light blue darken-2" type="submit" name="action" id="b_submit">
				    Log in
				    <i class="material-icons right">vpn_key</i>
				</button>
				<a href="#signup-modal" class="modal-trigger"><buton type="button" class="btn waves-effect waves-light blue lighten-1">Or sign up<i class="material-icons right">assignment</i></button></a>
				</div>
                            </form><!--
                            <div class="divider" style="margin-top:15px;"></div>
                            <p class="grey-text darken-4 center" style="margin-top:5px;margin-bottom:-15px;">If you don't have an account you can <a href="#signup-modal" class="modal-trigger">sign up here <i class="material-icons tiny">assignment</i></a>.</p>
-->                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@include('footer')
<div id="signup-modal" class="modal">
    <div class="modal-content">
      <form method="post" action="{{ route('Login.signup') }}">
      <h4>Sign up a new mail account</h4>
	<div class="container">
        @csrf
      <div class="row">
          <div class="input-field col m6 s12">
	      <i class="material-icons prefix">person</i>
              <input name="username_signup" value="{{ old('username_signup') }}" id="u_id_s" type="text" data-length="50" class="input-text @error('username') invalid @enderror validate" required>
              <label for="u_id_s">Username</label>
          </div>
          <!--<div class="col m1 valign-wrapper s2">
              <h5><b>@</b></h5>
          </div> -->
          <div class="input-field col m6">
	      <i class="material-icons prefix">@</i>
              <select id="d_id_s" name="domain_id_signup">
                  @if(sizeof($registerable_domains)==0) <option value="" disabled selected>No domains available</option> @endif
                  @foreach($registerable_domains as $domain)
		  <option value="{{ $domain->id }}" @if(old('domain_id_signup')==$domain->id) selected @endif >{{ $domain->name }}</option>
		  @endforeach
              </select>
              <label for="d_id_s">Domain</label>
          </div>
      </div>
      <div class="row">
          <div class="input-field col m12">
	      <i class="material-icons prefix">fingerprint</i>
              <input name="password_signup" id="p_id_s" type="password" class="@error('password_signup') invalid @enderror validate" required>
              <label for="p_id_s">Password</label>
          </div>
      </div>
      <div class="row">
          <div class="input-field col m12">
	      <i class="material-icons prefix">fingerprint</i>
              <input name="password_confirm" id="pc_id" type="password" class="@error('password_confirm') invalid @enderror validate" required>
              <label for="pc_id">Confirm password</label>
          </div>
      </div>
      <div class="row">
          <div class="col m3 offset-m1 s6 offset-s1">
              {!! captcha_img() !!}
          </div>
          <div class="col m1 s1 offset-s2">
              <a href="#!" id="refreshCaptcha"><button class="btn-floating blue darken-2"><i class="material-icons">autorenew</i></button></a>
          </div>
      <div>
      <div class="row">
          <div class="input-field col m12">
	      <i class="material-icons prefix">spellcheck</i>
              <input name="captcha" id="c_id" type="text" class="@error('captcha') invalid @enderror validate" required>
              <label for="c_id">Captcha</label>
          </div>
      </div>
    </div></div>
    <div class="modal-footer" style="text-align:center;">
      <button type="submit" class="waves-effect waves-light blue darken-2 btn">
	Sign up now
	<i class="material-icons right">send</i>
      </button>
    </div>
    </form>
  </div>
<script type="text/javascript">
$(document).ready(function(){
    $('.modal').modal();
    @if(old('captcha'))
    $('#signup-modal').modal('open');
    @endif
    $('select').formSelect();
    $('input.input-text').characterCounter();
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
<script type="text/javascript" src="{{asset('js/mailman.js')}}"></script>
    </body>
</html>
