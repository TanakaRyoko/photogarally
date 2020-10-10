<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charaset="utf-8">
        <title>Photoshow</title>
        
        <link rel="stylesheet" href="/css/app.css">
        
    </head>
    <body>
        @include('inc.navbar')
        <br>
        @include('inc.messages')
        <br>
        @yield('content')
    </body>
</html>