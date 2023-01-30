<?php
$con = mysqli_connect('127.0.0.1','root','','news');
// Check connection
if (mysqli_connect_errno())
{
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
//$myConnection = mysqli_connect($hostname, $username, $password, $database, 3307) or die("Error " . mysqli_error($myConnection));
?>