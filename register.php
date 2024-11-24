<?php
require 'db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hashedPassword = password_hash($password, PASSWORD_ARGON2ID);
    try {
        $sql = 'INSERT INTO tb_users (username, email, password) VALUES (?, ?, ?);';
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sss', $username, $email, $hashedPassword);
        if ($stmt->execute()) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to register']);
        }
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }
    die();
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <link rel="stylesheet" href="auth.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.min.css">
</head>
<body>
    <div class="container">
        <h2>Create a New Account</h2>
        <form id="register-form">
            <div class="form-group">
                <label for="username">Username</label>
                <input name="username" type="text" id="username" placeholder="Enter your username" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input name="email" type="email" id="email" placeholder="Enter your email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input name="password" type="password" id="password" placeholder="Create a password" required>
            </div>
            <div class="form-group">
                <label for="confirm-password">Confirm Password</label>
                <input name="confirm-password" type="password" id="confirm-password" placeholder="Confirm your password" required>
            </div>
            <button name="submit" type="submit" class="btn">Register</button>
            <p>Already have an account? <a href="login.php">Login here</a></p>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.all.min.js"></script>
    <script>
        const registerForm = document.getElementById('register-form');
        registerForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            const username = document.getElementById('username').value;
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirm-password').value;
            if (password !== confirmPassword) {
                document.getElementById('password').style.borderColor = 'red';
                document.getElementById('confirm-password').style.borderColor = 'red';
                swal.fire('Error', 'Passwords do not match', 'error');
                return;
            }
            const response = await fetch('register.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams({
                    username,
                    email,
                    password,
                }),
            });
            const data = await response.json();
            if (data.status === 'success') {
                swal.fire('Success', 'Account created successfully', 'success').then(() => {
                    window.location.href = 'login.php';
                });
            } else {
                swal.fire('Error', data.message || 'Failed to register', 'error');
            }
        });
    </script>
</body>
</html>
