<?php session_start(); ?>

<html>
<head>
<meta charset="UTF-8">
<title>Employee Home Page</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="css/EmployeeStyle.css">
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
<style>
.editt {
background-color: #fff;
color: #0abab5;
width: 140px;
height: 40px;
border-radius: 20px;
border: 1px solid #fff;
display: flex;
justify-content: center;
align-items: center;
margin-top: 10px;

}
.editt:hover {
border: 1px solid ;
transition: all ease 0.3s;
border-color: #0abab5;
font-weight: bold;
}
pre {
font-family: Arial, sans-serif;
}
.alert {
border-bottom:3px solid red;
position:relative;
left: 40%;
top: 100px;
background-color: #0abab5 ;
color : white;
}
</style>



</head>

<body>
<?php



$connection = mysqli_connect("localhost","root","","bluebirds");
$error = mysqli_connect_error();
if ($error != null){
echo "<p> could not connect to the database. <p>";
}
else {


if (isset($_SESSION["user_id"]) && $_SESSION["Role"]==="Employee") {
$id= $_SESSION["user_id"];
$role=$_SESSION["Role"];
}


$sql = "SELECT first_name, last_name, job_title, emp_number FROM Employee where id = '$id'";
$result = mysqli_query ($connection , $sql);

if ($result->num_rows > 0) {
while($row = $result->fetch_assoc()){
$fName = $row["first_name"];
$lName = $row["last_name"];
$job = $row["job_title"];
$empNum = $row["emp_number"];
}
}

?>
<header>
<div class='navbar'>
<a class='logo' accesskey='h'>
<img src='img/logo.png' alt= 'logo'>
</a>
<ul class='nav'>
<li><a href='logout.php' class='signoutbtn'>Sign out</a> </li>
</ul>
</div>
</header>
<?php

$sql2 = "SELECT * FROM employee WHERE id = $id ";
$result2 = mysqli_query($connection, $sql2);
if ($result->num_rows > 0) {

while ($row2 = mysqli_fetch_assoc($result2)) {

echo "<h2><span id='higlight' >Welcome <span> " . $fName. " " .$lName . "</span>!</span></h2> <br>" ;
echo " <h3 id='empid'>Employee's ID <span> " .$empNum." </span> </h3> <br> ";
echo " <h3 id='empjob'>Job Title <span> " .$job. " </span> </h3>";
}
}

?>

<table class="content-table1">
<!--Progress requests Table-->
<caption>In progress requests</caption>
<thead>
<tr>
<th> Requests </th>
<th> <pre> Edit </pre></th>



</tr>
</thead>


<tbody>
<?php


$sql = "SELECT status, service_id, id
FROM request
WHERE emp_id = '$id' ";
$result = mysqli_query($connection, $sql);
if ($result->num_rows > 0) {//1



while ($row = mysqli_fetch_assoc($result)) {
$status = $row["status"];
$sId = $row["service_id"];
$reqId = $row["id"];

$sql1 = "SELECT type FROM service WHERE id = '$sId'";
$result1 = mysqli_query($connection, $sql1);

while ($row = mysqli_fetch_assoc($result1)) {
$type = $row["type"];}

foreach ($result1 as $key => $row) {
if($status == "In progress"){



echo " <tr> <td><a href='RequestInfo.php?id=$reqId'> $reqId - $type </a></td> " ;
echo " <td> <button class ='editt' type='button' onclick= location.href='Editrequest.php?id=$reqId'; return false;>Edit </button></td> </tr> " ;

}}}}
?>


</tbody>
</table>


<table class="content-table2">
<!--Previous requests Table-->
<caption>Previous requests</caption>
<thead>
<tr>
<th>Requests</th>
<th> Status </th>
<th><pre> Edit </pre></th>

</tr>
</thead>
<tbody>
<?php

$sql = "SELECT status, service_id, id
FROM request
WHERE emp_id = '$id' ";
$result = mysqli_query($connection, $sql);
if ($result->num_rows > 0) {//1

while ($row = mysqli_fetch_assoc($result)) {
$status = $row["status"];
$sId = $row["service_id"];
$reqId = $row["id"];

$sql1 = "SELECT type FROM service WHERE id = '$sId'";
$result1 = mysqli_query($connection, $sql1);

while ($row = mysqli_fetch_assoc($result1)) {
$type = $row["type"];}

foreach ($result1 as $key => $row) {
if($status == "Approved" || $status == "Declined" ) {



echo " <tr><td><a href='RequestInfo.html'>".$reqId. " - " .$type. " </a></td> ";
if ($status == 'Approved')
echo " <td> <span class='green-dot'></span> " .$status. " </td> " ;
if ($status == 'Declined')
echo " <td> <span class='red-dot'></span> " .$status. " </td> " ;
echo " <td> <button class = 'editt' type='button' onclick= location.href='Editrequest.php?reqId=$reqId'; return false;>Edit </button></td> </tr> " ;

}//APP DEC
} }}// FOREACH

//1


}//big else

?>
</tbody>
</table>


<a href="AddRequest.php" class="btn"> Add Request</a>



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