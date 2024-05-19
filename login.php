<?php
include('db.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query to find the recruiter
    $sql = "SELECT * FROM users WHERE username='$username' AND role='recruiter'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $recruiter = $result->fetch_assoc();
        if (password_verify($password, $recruiter['password'])) {
            $_SESSION['user_id'] = $recruiter['id'];
            $_SESSION['username'] = $recruiter['username'];
            $_SESSION['role'] = $recruiter['role'];
            header("Location: dashboard.php");
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "No user found.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Login</h1>
    </header>
    <main>
        <form method="post" action="login.php">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <input type="submit" value="Login">
        </form>
    </main>
</body>
</html>
