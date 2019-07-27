<!-- This web application uses cookies. By clicking on the "Agree" button you allow this website to store cookies in your browser which are necessary for it to function correctly.
We respect your privacy, so we won't use cookies to track you, store any cookies from thired parties or pass any of your information to such. -->
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>MailMan - About</title>
@include('headdata')
    </head>
    <body>
@include('cookieConsent::index')
@include('navbar')
    <main>
        <div class="container">
            <div class="row">
		<h3 class="center">About MailMan</h3>
		<h6 class="center">Version 0.0.1</h6>
	    </div>
	    <div class="row">
		<div class="col m2 offset-m5 s12">
		    <img class="responsive-img" src="{{asset('images/MailMan_Logo.svg')}}">
		</div>
	    </div>
	    <div class="row">
		<div class="col s12 m6 offset-m3 center">
		    <p>Mail Manager ("<b>MailMan</b>" in short) is an open-source web-application written in <a href="https://www.php.net/">PHP</a> with the <a href="https://laravel.com/">Laravel framework</a> and the CSS-framework <a href="https://materializecss.com/">Materialize</a>.</p>
		    <p>Ther purpose of this application is to make the account management easier for server administrators who run a mailserver with the <a href="http://www.postfix.org/">Postfix</a> SMTP server and the <a href="https://www.dovecot.org/">Dovecot</a> IMAP and POP3 server.</p>
		    <h5>GitHub</h5>
		    <p>The source code of this project is publically available on GitHub. Click <a href="https://github.com/Earl0fPudding/MailMan">here</a> to get to the project page.</p>
		    <h5>License</h5>
		    <p>This project is licensed under the GNU General Public License Version 3 - see the LICENSE file on Git for details.</p>
		</div>
	    </div>
        </div>
    </main>
@include('footer')
    </body>
</html>
