<!DOCTYPE html>
<html>
<head>
    <title>Vendor Registration</title>
</head>
<body>
    <h1>Vendor Registration</h1>
    <form action="{{ url('vendor/register') }}" method="POST">
        @csrf
        <label>Name:</label>
        <input type="text" name="name" required><br>

        <label>Email:</label>
        <input type="email" name="email" required><br>

        <label>Password:</label>
        <input type="password" name="password" required><br>

        <label>Confirm Password:</label>
        <input type="password" name="password_confirmation" required><br>

        <label>Location:</label>
        <input type="text" name="location" required><br>


        <button type="submit">Register</button>
    </form>
</body>
</html>
