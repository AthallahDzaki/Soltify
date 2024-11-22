<?php
session_start();
if(isset($_POST['submit'])){
  $email = $_POST['email'];
  $password = $_POST['password'];
  var_dump($email);
  if($email == 'test123@gmail.com' && $password == 'test123'){
    echo "<script>alert('Login successful!')</script>";
    $_SESSION['email'] = $email;
    header('Location: wallet.php');
  } else {
    echo "<script>alert('Invalid email or password')</script>";
  }
}
?>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="auth.css">
    <style>
      #snackbar {
        visibility: hidden;
        min-width: 250px;
        background-color: #333;
        color: #fff;
        text-align: center;
        border-radius: 4px;
        padding: 16px;
        position: fixed;
        z-index: 1;
        left: 50%;
        bottom: 30px;
        font-size: 16px;
        transform: translateX(-50%);
      }

      #snackbar.show {
        visibility: visible;
        animation: fadeInOut 3s ease-in-out;
      }

      @keyframes fadeInOut {

        0%,
        100% {
          opacity: 0;
        }

        10%,
        90% {
          opacity: 1;
        }
      }
    </style>
  </head>
  <body>
    <div class="container">
      <h2>Login to Your Account</h2>
      <form method="post" action="login.php">
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
    <div id="snackbar">Login successful!</div>
    <script>
      function showSnackbar() {
        const snackbar = document.getElementById("snackbar");
        snackbar.classList.add("show");
        setTimeout(function() {
          snackbar.classList.remove("show");
        }, 3000);
      }
      document.body.onload = function() {
        if (localStorage.getItem("login") == "true") {
          window.location.href = "dashboard.php";
        }
      }
    </script>
  </body>
</html>