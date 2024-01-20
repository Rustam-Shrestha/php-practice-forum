<?php

$host="localhost";
$username="root";
$password="";
$dbname= "mydiscuss";
$con=mysqli_connect($host,$username,$password,$dbname);
if(mysqli_connect_errno()){
    echo "error is: ".mysqli_connect_error();
}

?>