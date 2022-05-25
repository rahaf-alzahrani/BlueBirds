<?php
session_start();
$connection = mysqli_connect("localhost","root","","bluebirds");
$error = mysqli_connect_error();
if ($error != null){
echo "<p> could not connect to the database. <p>"; }
else {


/*if (isset($_SESSION["id"])) {
$id= $_SESSION["id"];
}
*/

$reqId= $_GET['id'];
//$reqId = $_SESSION['reqId'];


$sql = "SELECT emp_id, service_id, description, attachment1, attachment2 FROM Request where id = '$reqId'";
$result = $connection->query($sql);

if ($result->num_rows > 0) {//1
while($row = $result->fetch_assoc()){
$emId = $row["emp_id"];
$sId = $row["service_id"];
$reqDes = $row["description"];
$attachment1=$row['attachment1'];
$attachment2= $row['attachment2'];

}

// $attachment1=$row['attachment1'];
// $attachment2= $row['attachment2'];

}


$sql1 = "SELECT * FROM service where id = '$sId'";
$result1 = mysqli_query ($connection , $sql1);
if ($result->num_rows > 0){



while($row= mysqli_fetch_assoc($result1)) {
$type = $row["type"];

}}

?>

<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Request </title>
<link rel="stylesheet" href="css/EditrequestStyle.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
.alert {

border-bottom:3px solid red;
position:relative;
left: 39%;
top: 30px;
background-color: #0abab5 ;
color : white; }
</style>


</head>
<script>
function Select() {
var fi = document.getElementById('files');
if(fi.files.length > 2){
alert("Please upload at most two files.");
}
else {
window.location.assign("RequestInfo.html");
}
}
</script>




<body>

<!-- NAV BARS START--------------------------------------->
<div class="navbar">
<a class="logo" accesskey="h">
<img src="img/logo.png" alt="logo">
</a>
<!-- Nav Links START
<option name ="type" value="$type" selected> <?php echo $type ?></option>



----------------------->
<ul class="nav">
<li><a href="index.html" class="signoutbtn">Sign out</a> </li>
</ul>
</div>




</header>
<main>
<?php if (isset($_SESSION['failed'])) {
// echo '<script>alert("Your request is updated successfully")</script>';

$msg= $_SESSION['failed'];
echo " <span class = 'alert'>" .$msg. "</span>" ;

unset ($_SESSION['failed']); } ?>

<form class="form" action="updatesql.php?id= <?php echo $reqId; ?>" method="post" enctype="multipart/form-data" >



<h2>EDIT REQUEST </h2>
<p type="Service"><select name="type" class="select">

<option value="Promotion" <?php if ($type == 'Promotion') {
echo"selected";
}
?>>Promotion</option>

<option value="Leave" <?php if ($type == 'Leave') {
echo"selected";
}
?>>Leave</option>

<option value="Resignation" <?php if ($type == 'Resignation') {
echo"selected";
}
?>>Resignation</option>

<option value="Allowance" <?php if ($type == 'Allowance') {
echo"selected";
}
?>>Allowance</option>

<option value="Health Insurance" <?php if ($type == 'Health Insurance') {
echo"selected";
}
?>>Health Insurance</option>

</select>
</p>
<br>
<label for="service" > Attachments </label><br>
<?php echo "<a href ='./".$attachment1."' target='_blank' > file1 </a> <br>";
echo "<a href ='./".$attachment2."' target='_blank' > file2 </a> <br>";

?>
<br>
<label for="myfile">Select files <br> </label>
<input type="file" id="myfile" name="myfile[]" multiple="multiple" >

<p type="Description">
            <textarea id="Des" name="description" cols="57" rows="7"> <?php echo $reqDes; ?></textarea>
            </p> 

<button class = 'buttonn' type='submit' name ='submit' >Update </button>
</form>
<?php } ?>
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
</body>



</html>