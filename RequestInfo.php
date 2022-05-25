<?php session_start(); ?>
<!DOCTYPE html>
<html>
<?php
require_once('include/connc.php');
include('include/func.php');

if (!isset($_SESSION['user_logged']))
  exit(header('Location: index.html'));

 if ($_SESSION['Role'] === "Manager") {
  $user_type = "manager";
} else {
  $user_type = "employee";
}

//here the if should be in request info page
if (isset($_GET['emsg']) && $_GET['emsg'] == "success")
$success_msg = "The request has been updated successfully.";

$user_id = $_SESSION['user_id'];

if ($user_type == "manager") {
  $user = getManagerInfo($user_id);
} else {
  $user = getEmployeeInfo($user_id);
}

$request_id = 0;
$request = false;

if (isset($_GET['id'])) {
  $request_id = $_GET['id'];
  $request = getRequestInfo($request_id);
}


if (isset($_GET['action'])) {
  if ($user_type == "manager") {
    $action = $_GET['action'];

    if ($action == "approve") {
      $result = approveRequest($request_id);
    } else if ($action == "decline") {
      $result = declineRequest($request_id);
    }

    if ($result) {
      header('Location: ' . $_SERVER['HTTP_REFERER']);
      exit();
    }
  }
}

if (isset($_SESSION['success'])) {

  $msg= $_SESSION['success'];
  echo "<span class = 'alert'>". $msg . " </span>";
  
  unset ($_SESSION['success']);
  }
?>

<style> 

.alert {
border-bottom:3px solid red;
position:relative;
left: 40%;
top: 250px;
background-color: #0abab5 ;
color : white;
}

</style>
<head>
<link rel="stylesheet" href=css/RequestInfoStyle.css>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<meta charset="UTF-8">
<title> Request Information </title>
</head>

<body>
<header>
  <!-- NAVBARS START--------------------------------------->
      <div class="navbar">
            <a class="logo" accesskey="h">
                <img src="img/logo.png" alt="logo">
            </a>
            <ul class="nav">
              <li><a href="logout.php" class="signoutbtn">Sign out</a> </li>
            </ul>
        </div>
  </header>

<div class="container">
  <svg viewBox="0 40 500 500" preserveAspectRatio="xMinYMin meet">
    <path d="M0,100 C150,200 350,0 500,100 L500,00 L0,0 Z" style="stroke: none; fill:var(--blue);"></path>
  </svg>
</div>


<main>
  <?php if ($success_msg) { ?>
    <div class="success-msg"><?= $success_msg ?></div>
  <?php } else if ($error_msg) { ?>
    <div class="error-msg"><?= $error_msg ?></div>
  <?php } ?>

<h1 id = "first"> Employee <br> <span><?= $request['emp_first_name'] ?> <?= $request['emp_last_name'] ?></span> </h1>


<?php if ($request) { ?>

<table align="center" class = "content-table" >
        <caption>Request Information </caption>
  <tr>
    <th> Service Type  </th>
    <td> <?= $request['service_type'] ?> </td>
  </tr>

 <!-- <span class="green-dot"></span> -->

  <tr>
    <th> Status  </th>
    <td> <?= $request['status'] ?></td>
  </tr>
    <tr>
    <th> Request Description  </th>
    <td><?= $request['description'] ?></td>
  </tr>
    <tr>
    <th>     Attachements  </th>
    <td>

    <?php if($request['attachment1'] != null ) { ?>
    <?php if (@is_array(getimagesize($request['attachment1']))) { ?>
  <img height="150" width="150" src="<?= $request['attachment1'] ?>">
<?php } else { ?>
  <a id="doc" target="_blank" href="<?= $request['attachment1'] ?>" download>View The File</a> <br><br>
<?php } ?>
    <?php } ?>

    <?php if($request['attachment2'] != null ) { ?>
<?php if (@is_array(getimagesize($request['attachment2']))) { ?>
  <img height="150" width="150" src="<?= $request['attachment2'] ?>">
<?php } else { ?>
  <a id="doc" target="_blank" href="<?= $request['attachment2'] ?>" download>View The File</a> <br><br>
<?php } ?>
<?php } ?>

            </td>
  </tr>

  
  <div>
          <?php if ($user_type == "manager") { ?>
            <?php if ($request['status'] == 'In progress' || $request['status'] == 'Declined') { ?>
              <input type="button" class="buttonnA" id="approve" value="Approve" onClick="approve(<?= $request['id'] ?>)">
            <?php } ?>
            <?php if ($request['status'] == 'In progress' || $request['status'] == 'Approved') { ?>
              <input type="button" class="buttonnD" id="decline" value="Decline" onClick="decline(<?= $request['id'] ?>)">
            <?php } ?>
          <?php } else { ?>
            <input type="button" class="buttonnE" id="edit" value="Edit" onClick="Edit(<?= $request['id'] ?>)">
          <?php } ?>
        </div>

  
  <?php } else { ?>
        <p>Request does not exist </p>
      <?php } ?>

</table>


</main>
         
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

        <script src="js/ReqInfo.js"> </script>

</body>
</html>
