<?php
include 'db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $conn->query("INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')");
    echo "<script>window.location.href='login.php';</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Signup</title>
    <style>
        body { font-family: Arial; background: #f1f1f1; display: flex; justify-content: center; align-items: center; height: 100vh; }
        form { background: white; padding: 30px; border-radius: 10px; box-shadow: 0 0 10px #ccc; width: 300px; }
        input[type=text], input[type=email], input[type=password] { width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ddd; border-radius: 5px; }
        input[type=submit] { background: #27ae60; color: white; border: none; padding: 10px; border-radius: 5px; cursor: pointer; }
        input[type=submit]:hover { background: #219150; }
    </style>
</head>
<body>
    <form method="post">
        <h2>Create Account</h2>
        <input type="text" name="username" placeholder="Username" required />
        <input type="email" name="email" placeholder="Email" required />
        <input type="password" name="password" placeholder="Password" required />
        <input type="submit" value="Sign Up" />
    </form>
</body>
</html>
