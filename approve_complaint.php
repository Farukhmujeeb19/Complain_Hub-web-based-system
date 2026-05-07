<?php
session_start();
include('../includes/connection.php');
include('../includes/base_urls.php');

if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header('Location: ' . BASE_URL_ADMIN . 'login.php');
    exit;
}



 if(   isset( $_GET['id'] ) && isset($_GET['action'])   )
 {

    $complaint_id = $_GET['id']; 

    $action = $_GET['action']; 

    $status = ""; 

    if($action=='approve')
    {

        $status = 'approved'; 
    }

    else{

        $status = 'disapproved'; 
    }


    $sql = "UPDATE complaints SET status = ? WHERE id= ?";
    
    $result = $conn->prepare($sql); 

    $result->bind_param("si", $status, $complaint_id); 

    if($result->execute())
    {
        header('Location:'.BASE_URL_ADMIN.'dashboard.php'); 
    }



 }




?>