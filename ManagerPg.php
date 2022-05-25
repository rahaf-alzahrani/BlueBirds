<?php
session_start();
require('include/connc.php');
include('include/func.php');

if (!isset($_SESSION['user_logged']))
  exit(header('Location: index.html'));
else if ($_SESSION['Role'] === 'Employee')
  exit(header('Location: EmployeePg.php'));

$user_id = $_SESSION['user_id'];

$user = getManagerInfo($user_id);
$services = getServices();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manager Home Page</title>
  <link rel="stylesheet" href="css/ManagerStyle.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script>
    function description(id) {
      var reqID = { reqID: id };
      $.ajax({
        type: "POST",
        url: "getDescription.php",
        success: function(data) {
         // var json = JSON.parse(data);
          $(".Desc").attr('title', data.description);
        }, data: reqID
      });
    }
  </script>
</head>

<body>

  <!-- NAVBARS START--------------------------------------->
  <header>
    <div class="navbar">
      <a class="logo" accesskey="h">
        <img src="img/logo.png" alt="logo">
      </a>
      <!-- Nav Links START----------------------->
      <ul class="nav">
        <li><a href="logout.php" class="signoutbtn">Sign out</a> </li>
      </ul>
    </div>
  </header>

  <h2> Welcome <?= $user['first_name'] ?> <?= $user['last_name'] ?> !</h2>

  <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br>

  <?php foreach ($services as $key => $service) { ?>
    <table class="content-table1">
      <caption>
        <?= $service['type'] ?>
      </caption>
      <thead>
        <tr class="col" id="Row">
          <th>Requests</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      </thead>

      <tbody>
        <?php
        $requests = getRequestsByServiceType($service['id']);
        if ($requests) {
        ?>

          <br>
          <?php foreach ($requests as $key => $request) { ?>
            <?php if ($request['status'] == 'In progress') { ?>
              <tr id="INp" style="background-color: #dddddd;">
                <td><a onmouseover="description(<?php echo $request['id']; ?>)" id="<?= $request['id'] ?>" href="RequestInfo.php?id=<?= $request['id'] ?>"> <abbr class="Desc" title=""> <?= $request['id'] ?>-<?= $request['emp_first_name'] ?> <?= $request['emp_last_name'] ?></a> </abbr> </td>
                <td id="Cstatus<?php echo $request['id']; ?>"> <span class="tefani-dot"></span> <?= $request['status'] ?></td>
                <td id="B<?php echo $request['id']; ?>"><input class="buttonnA" type="button" value="Approve" onClick="approve(<?= $request['id'] ?>)"><input class="buttonnD" type="button" value="Decline" onClick="decline(<?= $request['id'] ?>)"></td>
              </tr>
            <?php } ?>
          <?php } ?>
          <?php foreach ($requests as $key => $request) { ?>
            <?php if ($request['status'] != 'In progress') { ?>
              <tr>
                <td><a onmouseover="description(<?php echo $request['id']; ?>)" id="<?= $request['id'] ?>" href="RequestInfo.php?id=<?= $request['id'] ?>"> <abbr class="Desc" title=""> <?= $request['id'] ?>-<?= $request['emp_first_name'] ?> <?= $request['emp_last_name'] ?></a> </abbr> </td>
                <?php if ($request['status'] == 'Approved') { ?>
                  <td id="Cstatus<?php echo $request['id']; ?>"><span class="green-dot"></span> <?= $request['status'] ?></td>
                  <td id="B<?php echo  $request['id']; ?>"><input class="buttonnD" type="button" value="Decline" onClick="decline(<?= $request['id'] ?>)"></td>
                <?php } else { ?>
                  <td id="Cstatus<?php echo $request['id']; ?>"><span class="red-dot"></span> <?= $request['status'] ?></td>
                  <td id="B<?php echo $request['id']; ?>"><input class="buttonnA" type="button" value="Approve" onClick="approve(<?= $request['id'] ?>)"></td>
                <?php } ?>
              </tr>
            <?php } ?>
          <?php } ?>
        <?php } else { ?>
          <tr>
            <td>No requests found</td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  <?php } ?>


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

  <script src="js/ReqInfo2.js"> </script>
</body>

</html>