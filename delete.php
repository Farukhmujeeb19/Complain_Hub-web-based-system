<?php session_start(); 

require_once '../includes/connection.php';
require_once '../includes/base_urls.php';


if(isset($_GET['id']) && isset($_GET['action']))
{

    die(); 
    $com_id = $_GET['id']; 
    $sql = "DELETE FROM complaints WHERE id = '$com_id'"; 
    $result = mysqli_query($conn, $sql ); 

    if($result)

    header('Location:'.BASE_URL_ADMIN.'pract.php'); 
}

?>