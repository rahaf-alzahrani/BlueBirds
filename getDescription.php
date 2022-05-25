<?php
session_start();
require('include/connc.php');
include('include/func.php');

if (!isset($_SESSION['user_logged']))
  exit(header('Location: index.html'));
else if ($_SESSION['Role'] === 'Employee')
  exit(header('Location: EmployeePg.php'));

if (isset($_POST['reqID'])) {
  $reqID = $_POST['reqID'];
  $sql = "SELECT description FROM request WHERE id = '$reqID';";
  $result = mysqli_query($conn, $sql);

  if ($result->num_rows > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      $desc = $row;
    }
  }

  $jsonE = json_encode($desc);
  print $jsonE;
  header("Content-Type: text/plain");
}
