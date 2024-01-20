<?php

if($_SERVER["REQUEST_METHOD"]=='POST'){
    $error = false;
    $done = false;
    include "_dbconnect.php";
    $email = $_POST["suemail"];
    $name = $_POST["suname"];
    $password = $_POST["supwd"];

    $find = "SELECT * FROM `members` WHERE u_email='$email'";
    $data = mysqli_query($con,$find) or die(mysqli_connect_errno());
    $row = mysqli_num_rows($data);
    if($row>0){
        $error = true;
        header("Location:/practice//forum/index.php?signupsuccess=false&error=".$error);
    }else{

        $spassword =  password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO `members` (`u_name`, `u_email`, `u_password`, `created`) VALUES ('$name', '$email', '$spassword', current_timestamp())";
        
        $result = mysqli_query($con,$query) or die(mysqli_connect_errno());
        if($result){
            
            $done = true;
            header("Location:/practice/forum/index.php?signupsuccess=true&done=".$done);
            exit();
        }
    }
    }
    ?>