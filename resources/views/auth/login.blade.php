<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{asset('css/login.css')}}">
    
</head>
<body>
    <div class="wrapper fadeInDown">
        <div id="formContent">
            <!-- Tabs Titles -->
            <h2 class="active"> Sign In </h2>

            <!-- Icon -->
            <div class="fadeIn first">
                <h3>Sirah Presensi<h3>
            </div>

            <!-- Login Form -->
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <input type="text" id="login" class="fadeIn second" name="username" placeholder="Username" value="{{ old('username') }}" required>
                <input type="text" id="password" class="fadeIn third" name="password" placeholder="Password" autocomplete="off" required>
                <input type="submit" class="fadeIn fourth" value="Log In">
            </form>

        </div>
    </div>
</body>
</html>














