<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require('include/connc.php');
include('include/func.php');


if (isset($_POST['REQID'])) {
  $request_id = $_POST['REQID'];

  if (isset($_POST['status'])) {
    $status = $_POST['status'];

    if ($status == "Approved") {
      $result = approveRequest($request_id);
    } else if ($status == "Declined") {
      $result = declineRequest($request_id);
    }
  }
}
