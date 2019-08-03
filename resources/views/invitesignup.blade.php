<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>MailMan - Sign up</title>
@include('headdata')
    </head>
    <body>
@include('cookieConsent::index')
    <main>
        <div class="container">
	<div class="row center">
	    <div class="col m6 offset-m3 s12">
	        <h3>Sign up a new mail account</h3>
	    </div>
	</div>
	<div class="row">
		<div class="card col m6 offset-m3 s12">
		<div class="card-content">
		<form method="post" action="{{ route('Login.invitesignup') }}">
	        @csrf
      		    <div class="row">
          		<div class="input-field col m6 s12">
			    <i class="material-icons prefix">person</i>
              		    <input name="username" id="u_id" type="text" data-length="50" class="input-text validate @error('username') invalid @enderror" @if(session('name_preset')!==null) value="{{ session('name_preset') }}" disabled @else value="{{ old('username') }}" @endif required>
              		    <label for="u_id">Username</label>
          		</div>
          		<div class="col m6 s10 offset-s2">
          		    <h5>{{ '@'.session('domain_name') }}</h5>
          		</div>
		    </div>
	            <div class="row">
        	         <div class="input-field col m12">
			     <i class="material-icons prefix">fingerprint</i>
              		     <input name="password" id="p_id" type="password" class="validate @error('password') invalid @enderror" required>
              		     <label for="p_id">Password</label>
          		 </div>
      		    </div>
      		    <div class="row">
          	        <div class="input-field col m12">
			    <i class="material-icons prefix">fingerprint</i>
              		    <input name="password_confirm" id="pc_id" type="password" class="validate @error('password_confirm') invalid @enderror" required>
              		    <label for="pc_id">Confirm password</label>
          		</div>
      		    </div>
		    <div class="row" style="text-align: center;">
		        <button type="submit" class="waves-effect waves-light blue darken-2 btn">Sign up<i class="material-icons right">send</i></button>
		    </div>
		</form>
		</div>
		</div>
		</div>
        </div>
    </main>
@include('footer')
<script>
$(document).ready(function(){
    $('input.input-text').characterCounter();
});
</script>
    </body>
</html>
