<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <style>
        .container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        form {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        h1 {
            margin-bottom: 20px;
        }
        .token-link {
            margin-top: 20px;
            color: blue;
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Registration Form</h1>
    @if (session('success'))
        <div>{{ session('success') }}</div>
    @endif
    <div>
        <form action="{{ route('register.store') }}" method="POST">
            @csrf
            <div>
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div>
                <label for="mobile">Phone number:</label>
                <input type="text" id="mobile" name="mobile" required>
            </div>
            <div>
                <button type="submit">Register</button>
            </div>
        </form>
        @if (session('token'))
            <div class="token-link">
                <a href="{{ url('interact/' . session('token')) }}">Your registration token</a>
            </div>
        @endif
    </div>
</div>
</body>
</html>
