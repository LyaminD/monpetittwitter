@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Mon petit Twitter</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">


<body>



    <div class="container">

        <div class="tribunal text-center my-5">
            <img src="{{ asset("images/tribunal.jpg") }}">
        </div>

        
        <div class="button-div"> <button class="signup-button">Signup</button> 
        <button class="login-button">Login</button>
        </div>
    
    </div>

</body>

</html>
@endsection