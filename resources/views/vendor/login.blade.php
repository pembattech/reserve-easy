<!DOCTYPE html>
<html>
<head>
    <title>Restaurant Login</title>
</head>
<body>
    <h1>Restaurant Login</h1>
    <form action="{{ url('vendor/login') }}" method="POST">
        @csrf
        <label>Email:</label>
        <input type="email" name="email" required><br>

        <label>Password:</label>
        <input type="password" name="password" required><br>

        <button type="submit">Login</button>
    </form>
</body>
</html>
