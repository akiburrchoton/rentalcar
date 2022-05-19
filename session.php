<?php
    // Starting session
    session_start();

    // Initializing the session to store car id 
    if(empty($_SESSION['carId'])){
        $_SESSION['carId']= array();
    }

    // Storing the car id into the session array
    if(isset($_POST["id"])){
        // If the car is not in the session array then push it
        if(!in_array($_POST["id"], $_SESSION['carId'])){
            array_push($_SESSION['carId'], $_POST["id"]);
        }
    }
    
    // Removing the car id from the session array
    if(isset($_POST['rid'])){
        $rid = $_POST['rid'];
        $index = array_search("$rid", $_SESSION["carId"]); // Storing the index of the car id to use in UNSET function
        unset($_SESSION["carId"][$index]); // Removing the car id by unsetting it from the array    
    }
?>