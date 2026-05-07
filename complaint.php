<?php
session_start();
require_once('../includes/connection.php');
require_once('../includes/base_urls.php');



        $current_user = $_SESSION['username']; 

        $subject = $_POST['subject']; 

        $type = $_POST['type']; 

        $detail = $_POST['detail']; 


        $file = $_FILES['file']['name']; 

        $source = $_FILES['file']['tmp_name']; // file temporary name when upload to server

        $destination = '../uploads/'.basename($file); 
                             
        if( move_uploaded_file( $source, $destination  )   )

        {

                echo "file submitted"; 
        }

        $sql = " INSERT INTO complaints (username, subject,  type, detail, file ) VALUES(?, ?, ?, ?, ?) "; 
        $result = $conn->prepare($sql); 

        $result->bind_param("sssss", $current_user,$subject, $type, $detail, $file); 
        
        if($result->execute())
        {

                $_SESSION['success_message'] = "Complaint submitted successfully"; 
                header('Location:'.BASE_URL_USER.'dashboard.php'); 
        } 





?>
