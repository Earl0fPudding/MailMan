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
                <div class="col s12 m4 offset-m4 center-align">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-title red-text lighten-1"><b>Admin login</b></div>
                            <form method="post" action="{{route('Login.adminLogin')}}">
                                @csrf
                                <div class="row">
                                    <div class="input-field col s12">
					<i class="material-icons prefix">person</i>
                                        <input type="text" value="{{ old('username') }}" class="validate @error('username') invalid @enderror" name="username" id="u_id" required autofocus>
                                        <label for="u_id">Username</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
					<i class="material-icons prefix">fingerprint</i>
                                        <input name="password" id="p_id" type="password" class="validate" required>
                                        <label for="p_id">Password</label>
                                    </div>
                                </div>
                                <button class="btn waves-effect waves-light blue darken-2" type="submit" name="action" id="b_submit">
				    Log in
				    <i class="material-icons right">vpn_key</i>
				</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@include('footer')
    </body>
</html>
