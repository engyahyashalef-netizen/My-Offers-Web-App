<?php
$host ="localhost";
$user ="root";
$password= "";
$dbname = "myoffers";

$con =mysqli_connect($host,$user,$password,$dbname);

if(!$con){

	echo mysqli_connect_error($con);
}
?> 