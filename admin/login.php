<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();


require_once 'config.php';

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = $conn->prepare("SELECT * FROM admin WHERE username = ?");
    $query->bind_param("s", $username);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows === 1) {
        $admin = $result->fetch_assoc();
        if (password_verify($password, $admin['password'])) {
            $_SESSION['admin'] = $admin['username'];
            header("Location: admin.php");
            exit;
        } else {
            $error = "Password salah.";
        }
    } else {
        $error = "Username tidak ditemukan.";
    }

    $query->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Admin</title>
    <style>
        body {
            font-family: Arial;
            background-color: #eef3f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-box {
            background: white;
            padding: 40px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border-radius: 8px;
            width: 300px;
        }

        h2 {
            text-align: center;
            color: #003366;
        }

        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            width: 100%;
            background: #003366;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 4px;
        }

        .error {
            color: red;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="login-box">
    <h2>Login Admin</h2>
    <?php if (!empty($error)) echo "<div class='error'>$error</div>"; ?>
    <form method="POST">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="submit" value="Masuk">
    </form>
</div>

</body>
</html>
