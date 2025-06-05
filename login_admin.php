<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION['username'] = $username;
        header("Location: admin.php");
    } else {
        $error = "wrong username or password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
    <style>
        /* Reset CSS */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #eaeaea; /* Neutral light gray background */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #ffffff; /* White background for container */
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2); /* Slightly darker shadow */
            width: 400px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333; /* Dark gray color */
        }

        .input-field {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ccc; /* Neutral border color */
            border-radius: 5px;
            font-size: 16px;
            transition: border-color 0.3s;
        }

        .input-field:focus {
            border-color: #777; /* Darker border on focus */
            outline: none;
        }

        .submit-button {
            width: 100%;
            padding: 12px;
            background-color: #555; /* Gray color for button */
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .submit-button:hover {
            background-color: #333; /* Darker gray on hover */
        }

        .error-message {
            text-align: center;
            margin-top: 10px;
            color: red;
        }

        .register-link {
            text-align: center;
            margin-top: 15px;
        }

        .register-link a {
            color: #555; /* Gray color for link */
            text-decoration: none;
        }

        .register-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <form method="POST" class="login-form" autocomplete="off">
            <h2>Login</h2>
            <input type="text" name="username"  placeholder="Masukkan Username" class="input-field" autocomplete="off" required>
            <input type="password" name="password"  placeholder="Masukkan Password" class="input-field" autocomplete="new-password" required>
            <button type="submit" class="submit-button">Login</button>
            <p class="error-message"><?php if (isset($error)) echo $error; ?></p>
            
        </form>
    </div>
</body>
</html>