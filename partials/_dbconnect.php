<?php
    $servername="localhost";
    $username="root";
    $password="";
    $database="images";

    $conn=mysqli_connect($servername,$username,$password,$database);
    if(!$conn){
        echo"There was an error while connecting to the database!";
    }
?>