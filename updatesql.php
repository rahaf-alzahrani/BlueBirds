<?php
session_start();
$connection = mysqli_connect("localhost","root","","bluebirds");
$error = mysqli_connect_error();
if ($error != null){
echo "<p>Could not connect to the database. <p>";
exit($output);
}
else {
$reqId = $_GET['id'];

if(isset($_POST['submit']))
{


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
if (!file_exists("./upload_files/" . $reqId)) {
mkdir("./upload_files/" . $reqId, 0777, true);
}
//Setup our new file path
$newFilePath = "./upload_files/" . $reqId . "/" . $_FILES['myfile']['name'][$i];
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
$ID3=$_GET['id'];
$typee=$_POST['type'];
$descriptionn=$_POST['description'];
$attachment1 = isset($files[0]) ? mysqli_real_escape_string($connection, $files[0]) : '';
$attachment2 = isset($files[1]) ? mysqli_real_escape_string($connection, $files[1]) : '';
if($_POST['type'] == "Promotion")
$service_id = "1";
else if ($_POST['type'] == "Leave")
$service_id = "2";
else if ($_POST['type'] == "Resignation")
$service_id = "3";
else if ($_POST['type'] == "Allowance")
$service_id = "4";
else if($_POST['type'] == "Insurance")
$service_id = "5";
//$file2=$_FILES['file']['name'];
if ( empty(trim($descriptionn))) {
$_SESSION ['failed'] = 'YOU SHOULD FILL THE DESCRIPTION !';
header("location: Editrequest.php?id=$reqId");
exit();
}


$sqlipdate1 = "UPDATE Request SET service_id = '$service_id' , description = '$descriptionn', attachment1 = '$attachment1', attachment2 = '$attachment2' where id = '$ID3' ";



if ($connection->query($sqlipdate1) === TRUE ) {
$_SESSION ['success'] = ' UPDATED SUCCESSFULLY';
header("location: RequestInfo.php?id=$reqId"); //go to reqinfo
exit();
} }
else {
echo '<script>alert("Error in updating your request")</script>' . $connection->error;

}



}//if submit
}//big else


?>