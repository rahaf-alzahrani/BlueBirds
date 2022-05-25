<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

    <?php
    require_once('include/connc.php');
    include('include/func.php');
    
    if (!isset($_SESSION['user_logged']))
      exit(header('Location: index.html'));
    else if ($_SESSION['Role'] === "Manager")
      exit(header('Location: ManagerPg.php'));
    
    $user_id = $_SESSION['user_id'];
        
    $user = getEmployeeInfo($user_id);
    
    $services = getServices();
    
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $service_type = isset($_POST['service_type']) ? $_POST['service_type'] : '';
      $description = isset($_POST['description']) ? $_POST['description'] : '';
    
      $next_id = getNextID("Request");
    
      $uploaded = true;
      $files = array_filter($_FILES['myfile']['name']); //Use something similar before processing files.
      // Count the number of uploaded files in array
      $total_count = count($_FILES['myfile']['name']);
      // Loop through every file
      for ($i = 0; $i < $total_count; $i++) {
        //The temp file path is obtained
        $tmpFilePath = $_FILES['myfile']['tmp_name'][$i];
        //A file path needs to be present
        if ($tmpFilePath != "") {
          if (!file_exists("./upload_files/" . $next_id)) {
            mkdir("./upload_files/" . $next_id, 0777, true);
          }
          //Setup our new file path
          $newFilePath = "./upload_files/" . $next_id . "/" . $_FILES['myfile']['name'][$i];
          //File is uploaded to temp dir
          if (move_uploaded_file($tmpFilePath, $newFilePath)) {
            //Other code goes here
            $files[$i] = $newFilePath;
          } else {
            $uploaded = false;
            $error_msg = "Can not upload files.";
          }
        }
      }
    
      if ($uploaded) {
        $request_id = addRequest($user_id, $service_type, $description, $files);
        if ($request_id > 0) {
          header("location: RequestInfo.php?id=$request_id&msg=success");
          exit();
        }
      }
    }
    
    ?>    

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Request</title>
    <link rel="stylesheet" href="css/AddReqStyle.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <header>
        <!-- NAVBARS START--------------------------------------->
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
    <main>

        <form class="form" id="form" enctype="multipart/form-data" method="post">
            <h2>NEW REQUEST</h2>
            <p type="Service Type">
            <select  class="select" id="service_type" name="service_type" required>
        <?php foreach ($services as $service) { ?>
          <option value="<?= $service['id'] ?>"><?= $service['type'] ?></option>
        <?php } ?>
      </select>
            </p>

            <p type="Attachments"><input type="file" id="myfile" name="myfile[]" multiple></input></p>
            <p type="Description">
            <textarea id="Des" placeholder=" Write a description" name="description" cols="57" rows="7"></textarea>
            </p>
            <input type="submit" value="Send Request" class="buttonn" onclick="addRequest();return false;"></input>

            <?php if ($success_msg) { ?>
        <div class="success-msg"><?= $success_msg ?></div>
      <?php } else if ($error_msg) { ?>
        <div class="error-msg"><?= $error_msg ?></div>
      <?php } ?>

        </form>

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

    <script src="js/AddRequest.js"></script>

</body>

</html>