<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In • AgoraTrade</title>
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

        .login-container {
            width: 600px;
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 40px;
        }

        .login-container h2 {
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
            background-color: #ffe0a9;
            color: #777;
            border: 1px #ccc solid;
            border-radius: 15px 0 15px 0;
            font-size: 14px;
            cursor: pointer;
        }

        .form-group button:hover {
            background-color: #f7d9a3;
        }

        .signup-link {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
        }

        .signup-link a {
            text-decoration: none;
            color: #ffe0a9;
        }

        .signup-link a:hover {
            color: #f7d9a3;
        }

        .logo-hack{
            text-align: center;
            padding-bottom: 20px;
        }

        .alert{
            padding: 0;
            border-radius: 15px 0 15px 0;
            font-size: 10px;
            text-align: center;
        }

        .alert p{
            margin-bottom: 10px;
            margin-top: 10px;
        }

        .contain{
            justify-content: center;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="logo-hack">
            <img height="60px" width="60px" src="{{ asset('letter-a-block.png') }}" /> 
        </div>    
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <input type="email" id="email" name="email" placeholder="Enter your email address" required>
            </div>
            <div class="form-group" style="position: relative;">
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
                <span onclick="togglePassword('password', this)" style="position:absolute; right:14px; top:50%; transform:translateY(-50%); cursor:pointer; color:#aaa; font-size:13px; user-select:none;">Show</span>
            </div>
            <div class="form-group">
                <button type="submit">Log In</button>
            </div>
            @if(session('success'))
                <script>
                    alert("{{ session('success') }}");
                </script>
            @endif
            <div class="contain">
            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif
            </div>
        </form>
        <div class="signup-link">
            Don't have an account? <a href="/signup">Sign Up</a>
        </div>
    </div>


    @if(!Auth::check())
        <script>
        // Check for pending search when login page loads    
        document.addEventListener('DOMContentLoaded', function() {
        const pendingSearch = localStorage.getItem('pendingSearch');
        if (pendingSearch) {
            const searchData = JSON.parse(pendingSearch);
            const queryString = new URLSearchParams(searchData).toString();
            
            // Update the login form's redirect URL
            const redirectInput = document.querySelector('input[name="redirect"]');
            if (redirectInput) {
                redirectInput.value = `/store?${queryString}`;
            }
        }
    });


        document.addEventListener('DOMContentLoaded', function() {
            // Store pending search in localStorage when form is submitted
            const searchForm = document.getElementById('searchForm');
            if (searchForm) {
                searchForm.addEventListener('submit', function(e) {
                    const searchData = {
                        search: this.elements.search.value,
                        category: this.elements.category.value
                    };
                    localStorage.setItem('pendingSearch', JSON.stringify(searchData));
                });
            }

            const pendingSearch = localStorage.getItem('pendingSearch');
            if (pendingSearch && window.location.pathname === '/login') {
                const searchData = JSON.parse(pendingSearch);
                const queryString = new URLSearchParams(searchData).toString();
                localStorage.removeItem('pendingSearch');
                
                window.location.href = `/store?${queryString}`;
            }
        });
        </script>
    @endif

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