<?php
session_start();
include 'db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = $_POST['email'];
  $password = $_POST['password'];
  try {
    $sql = 'SELECT * FROM tb_users WHERE email = ?;';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows === 1) {
      $user = $result->fetch_assoc();
      if (password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user;
        echo json_encode(['status' => 'success']);
      } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid email or password']);
      }
    } else {
      echo json_encode(['status' => 'error', 'message' => 'Invalid email or password']);
    }
  } catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
  }
  die();
}
if (isset($_SESSION['user'])) {
  header('Location: dashboard.php');
  die();
}
?>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
  <link rel="stylesheet" href="auth.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.min.css">
</head>
<body>
  <div class="container">
    <h2>Login to Your Account</h2>
    <form id="login-form">
      <div class="form-group">
        <label for="email">Email</label>
        <input name="email" type="email" id="email" placeholder="Enter your email" required>
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input name="password" type="password" id="password" placeholder="Enter your password" required>
      </div>
      <button name='submit' type="submit" class="btn">Login</button>
      <p>Don't have an account? <a href="register.php">Register here</a>
      </p>
    </form>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.all.min.js"></script>
  <script>
    const loginForm = document.getElementById('login-form');
    loginForm.addEventListener('submit', async (e) => {
      e.preventDefault();
      const email = document.getElementById('email').value;
      const password = document.getElementById('password').value;
      const response = await fetch('login.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: new URLSearchParams({
          email,
          password
        })
      });
      const result = await response.json();
      if (result.status === 'success') {
        Swal.fire({
          icon: 'success',
          title: 'Login Successful',
          showConfirmButton: false,
          timer: 1500,
        }).then(() => {
          window.location = 'dashboard.php';
        });
      } else {
        Swal.fire({
          icon: 'error',
          title: 'Login Failed',
          text: result.message,
        });
      }
    });
  </script>
</body>
</html>