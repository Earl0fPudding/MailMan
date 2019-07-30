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
	<div class="row">
	    <div class="col m6 offset-m3 s12">
	        <h3>Sign up a new mail account</h3>
	    </div>
	</div>
	<div class="row">
		<div class="card col m5 offset-m3 s12">
		<div class="card-content">
		<form method="post" action="{{ route('Login.invitesignup') }}">
	        @csrf
      		    <div class="row">
          		<div class="input-field col m6">
              		    <input name="username" id="u_id" type="text" class="validate @error('username') invalid @enderror" @if(session('name_preset')!==null) value="{{ session('name_preset') }}" disabled @else value="{{ old('username') }}" @endif required>
              		    <label for="u_id">Username</label>
          		</div>
          		<div class="col m6">
          		    <h5>{{ '@'.session('domain_name') }}</h5>
          		</div>
		    </div>
	            <div class="row">
        	         <div class="input-field col m12">
              		     <input name="password" id="p_id" type="password" class="validate @error('password') invalid @enderror" required>
              		     <label for="p_id">Password</label>
          		 </div>
      		    </div>
      		    <div class="row">
          	        <div class="input-field col m12">
              		    <input name="password_confirm" id="pc_id" type="password" class="validate @error('password_confirm') invalid @enderror" required>
              		    <label for="pc_id">Confirm password</label>
          		</div>
      		    </div>
		    <div class="row">
			<div class="col m2 offset-m5">
			    <button type="submit" class="waves-effect waves-light blue darken-2 btn">Sign up</button>
			</div>
		    </div>
		</form>
		</div>
		</div>
		</div>
        </div>
    </main>
@include('footer')
    </body>
</html>
