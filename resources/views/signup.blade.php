<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up • AgoraTrade</title>
    <link rel="icon" href="{{ asset('letter-a-block.png') }}" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .signup-container {
            width: 600px;
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 40px;
        }

        .signup-container h2 {
            text-align: center;
            margin-bottom: 30px;
            font-weight: bold;
            color: #333;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            color: #555;
            display: block;
            margin-bottom: 5px;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 15px 0 15px 0;
            outline: none;
            font-size: 14px;
        }

        .form-group input:focus {
            border-color: #ffe0a9;
        }

        .form-group button {
            width: 100%;
            padding: 12px;
            border: none;
            border: 1px #ccc solid;
            background-color: #ffe0a9;
            color: #777;
            border-radius: 15px 0 15px 0;
            font-size: 14px;
            cursor: pointer;
        }

        .form-group button:hover {
            background-color: #f7d9a3;
        }

        .form-group-one {
            display: flex;
            flex-direction: row;
            margin-bottom: 20px;
        }

        .inputOne{
            width: 50%;
        }

        .inputTwo{
            width: 33.5%;
        }

        .form-group-one label {
            color: #555;
            display: block;
            margin-bottom: 5px;
        }

        .form-group-one input {
            width: 150%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 15px 0 15px 0;
            outline: none;
            font-size: 14px;
        }

        .form-group-one input:focus {
            border-color: #ffe0a9;
        }

        .form-group-one button {
            width: 100%;
            padding: 12px;
            border: none;
            background-color: #ffe0a9;
            color: #333;
            font-weight: bold;
            border-radius: 15px 0 15px 0;
            font-size: 4px;
            cursor: pointer;
        }

        .form-group-one button:hover {
            background-color: #f7d9a3;
        }

        .login-link {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
        }

        .login-link a {
            text-decoration: none;
            color: #ffe0a9;
        }

        .login-link a:hover {
            color: #f7d9a3;
        }

        .error {
            color: red;
            font-size: 0.9em;
        }

        .logo-hack{
            text-align: center;
            padding-bottom: 20px;
        }

        .alert {
            background-color: #f8d7da;
            color: #721c24;
            padding: 10px;
            font-size: 10px;
            border: 1px solid #f5c6cb;
            border-radius: 5px;
            margin-bottom: 15px;
        }
        
    </style>
</head>
<body>
    <div class="signup-container">
        <div class="logo-hack">
                <img height="60px" width="60px" src="{{ asset('letter-a-block.png') }}" />
        </div>       
        <form method="POST" action="{{ route('signup.store') }}">
            @csrf
            <div class="form-group-one">
                <div class="inputOne">
                    <input type="text" id="fullname" name="fullname" placeholder="Enter your full name" required>
                </div>  
                <div class="inputTwo"> 
                    <input type="text" id="username" name="username" placeholder="Enter your user name" required>
                </div>
            </div>
            <div class="form-group">
                <input type="email" id="email" name="email" placeholder="Enter your email address" required>
            </div>
            <div class="form-group" style="position: relative;">
                <input type="password" id="password" name="password" placeholder="Create a password" required>
                <span onclick="togglePassword('password', this)" style="position:absolute; right:14px; top:50%; transform:translateY(-50%); cursor:pointer; color:#aaa; font-size:13px; user-select:none;">Show</span>
            </div>

            <div class="form-group" style="position: relative;">
                <input type="password" id="confirm-password" name="password_confirmation" placeholder="Confirm your password" required>
                <span onclick="togglePassword('confirm-password', this)" style="position:absolute; right:14px; top:50%; transform:translateY(-50%); cursor:pointer; color:#aaa; font-size:13px; user-select:none;">Show</span>
            </div>
            @if ($errors->any())
                <script>
                    alert("{{ $errors->first() }}");
                </script>
            @endif
            <div class="form-group">
                <button type="submit">Sign Up</button>
            </div>
        </form>
        <div class="login-link">
            Already have an account? <a href="/login">Log In</a>
        </div>
    </div>

    <script>
    function togglePassword(id, el) {
        const input = document.getElementById(id);
        if (input.type === 'password') {
            input.type = 'text';
            el.textContent = 'Hide';
            el.style.color = '#ffe0a9';
        } else {
            input.type = 'password';
            el.textContent = 'Show';
            el.style.color = '#aaa';
        }
    }
    </script>
</body>
</html>