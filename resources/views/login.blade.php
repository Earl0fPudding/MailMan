<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>MailMan - Login</title>
@include('headdata')
    </head>
    <body>
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
                            <form method="post" action="/login">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@include('footer')
    </body>
</html>
