<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>MailMan - </title>
@include('headdata')
    </head>
    <body>
@include('cookieConsent::index')
@include('navbar')
    <main>
        <div class="container">
            
        </div>
    </main>
@include('footer')
    </body>
</html>
