
<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

  <?php
  ini_set('display_errors', 1);
  require_once('include/connc.php');
  include('include/func.php');
  
  if (isset($_SESSION['user_logged'])) {
    if ($_SESSION['Role'] === 'Manager') {
      exit(header('Location: ManagerPg.php'));
    }
    else 
    exit(header('Location: EmployeePg.php'));
}
  
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $emp_number = isset($_POST['id']) ? $_POST['id'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
  
    $user_id = loginEmployee($emp_number, $password);
  
    if ($user_id > 0) {
      $_SESSION['user_logged'] = true;
      $_SESSION['user_id'] = $user_id;
      $_SESSION['Role'] = "Employee";
      echo '<script language="javascript">window.location = "EmployeePg.php";</script>';
      exit();
    }
  }
  
  ?>
    
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Employee Login</title>
  <link rel="stylesheet" href="css/IndexStyle.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
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
        <li><a href="EmpLogin.php" accesskey="l" id="active">EMPLOYEE LOGIN</a></li>
        <li><a href="MangLogin.php" accesskey="m">MANAGER LOGIN</a></li>
      </ul>
    </div>
  </header>

  <div class="center">
    <h1>Employee Login</h1>
    <form id="form" action="EmpLogin.php" method="post"> 

      <div class="txt_field">
        <div class="input-control">
          <label for="id">Employee's ID</label>
          <input id="id" name="id" type="text">
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

      
      <div class="signup_link">
        Not registered? <a href="EmpSignUp.php">Sign Up</a>
      </div>

      
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

  <script defer src="js/employeeloginscript.js"> </script>

</body>

</html>