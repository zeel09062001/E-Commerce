<?php
session_start();

error_reporting(0);

error_reporting(E_ALL);
ini_set('display_errors', 1);

include('connections/con.php');

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM admin WHERE username = ? AND password = ?";
    $query = $conn->prepare($sql);
    $query->bind_param('ss', $username, $password);
    $query->execute();
    $result = $query->get_result();


    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        $_SESSION['username'] = $username;

        if (isset($row['status'])) {
            $_SESSION['status'] = $row['status'];
        }
        $_SESSION['status'] = $status;
        header("Location: addadmin.php");
    } else {
        $loginError = "Invalid username or password";
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/style.css">

    <style>
        input {
            background: linear-gradient(135deg, #4e7eff, #28a2eb);
            color: #fff;
            padding: 12px;
            margin-bottom: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-inline: 20px;
            font-size: medium;
        }

        a {
            background: linear-gradient(135deg, #FF0000, #FF0000);
            color: #fff;
            padding: 12px;
            margin-bottom: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-inline: 20px;
            font-size: medium;
            text-decoration: none;
        }
    </style>
    <title>Login Page</title>
</head>

<body>
    <div class="login-container">
        <h2>Login</h2>

        <form method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <input type="submit" name="login" value="Login">

            <a href="../index.php">Cancel</a>
        </form>
    </div>

</body>

</html>