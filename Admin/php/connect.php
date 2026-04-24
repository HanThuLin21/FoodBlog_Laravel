<?php 
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "foodblog";

    $db = mysqli_connect($servername,$username,$password,$database);

    if($db == false){
        die("Error" . mysqli_connect_error($db));
    }
?>