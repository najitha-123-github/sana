<?php 
    session_start();
    if(!isset($_SESSION["staffauth"]) ||  $_SESSION["staffauth"] !== true){
        // var_dump($_SESSION["userauth"]);
        header("Location: ./home.html");
        exit();
    }
    
?>