<?php
session_start();
require_once('include/connc.php');
include('include/func.php');

if (isset($_SESSION['user_logged'])) {
  if ($_SESSION['Role'] === 'Manager' )
    exit(header('Location: ManagerPg.php'));
  else
    exit(header('Location: EmployeePg.php'));
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $username = isset($_POST['username']) ? $_POST['username'] : '';
  $password = isset($_POST['password']) ? $_POST['password'] : '';

  $user_id = loginManager($username, $password);

  if ($user_id > 0) {
    $_SESSION['user_logged'] = true;
    $_SESSION['user_id'] = $user_id;
    $_SESSION['Role'] = "Manager";
    header("location: ManagerPg.php");
    exit();
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manager Login</title>
  <link rel="stylesheet" href="css/IndexStyle.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <script defer src="js/mangerloginscript.js"></script>
</head>

<body>
  <!-- NAVBARS START--------------------------------------->
  <header>
    <div class="navbar">
      <a class="logo" href="index.html" accesskey="h">
        <img src="img/logo.png" alt="logo">
      </a>
      <!-- Nav Links START----------------------->
      <ul class="nav">
        <li><a href="index.html" accesskey="h">HOME</a></li>
        <li><a href="contact.html" accesskey="c">CONTACT</a> </li>
        <li><a href="EmpLogin.php" accesskey="l">EMPLOYEE LOGIN</a></li>
        <li><a href="MangLogin.php" accesskey="m" id="active">MANAGER LOGIN</a></li>
      </ul>
    </div>
  </header>


  <div class="center">
    <h1>Manager Login</h1>
    <form id="form" method="post"action="MangLogin.php">

      <div class="txt_field">
        <div class="input-control">
          <label for="username">Username</label>
          <input id="username" name="username" type="text">
          <div class="error"></div>
        </div>
      </div>

      <div class="txt_field">
        <div class="input-control">
          <label for="password">Password</label>
          <input id="password" name="password" type="password">
          <div class="error"></div>
        </div>
      </div>

      <input class="button" type="submit" value="Log in" onclick=" validateInputs() ;return false;">

      <?php if ($success_msg) { ?>
        <div class="success-msg"><?= $success_msg ?></div>
      <?php } else if ($error_msg) { ?>
        <div class="error-msg"><?= $error_msg ?></div>
      <?php } ?>

    </form>
  </div>

  <footer>
    <div class="footer-content">
      <h3>BlueBirds</h3>
      <p>Simplest Employees Management System!
      </p>
      <ul class="socials">
        <li><a href="https://www.facebook.com/"><i class="fa fa-facebook"></i></a></li>
        <li><a href="https://twitter.com/"><i class="fa fa-twitter"></i></a></li>
      </ul>
    </div>
    <div class="footer-bottom">
      <p>©2022 BlueBirds | Some Rights Reserved</p>
    </div>
  </footer>

</body>

</html>