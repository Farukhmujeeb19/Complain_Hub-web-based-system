<?php session_start();
 error_reporting(0);
require_once('../includes/connection.php');
include_once('../includes/base_urls.php');

if(isset($_POST['submit'])) 

    

    $username = $_POST['username']; 

    $password = $_POST['password']; 

  //1. first step for overcoming sql injection is to use placeholder ? in query 

    $sql = " SELECT * FROM users where username = ? AND password = ? "; 

    //2 second step                                                                       similarly to compare encrypted password then i will use password_verify builtin function
    $result =  $conn->prepare($sql );
    
    // 3rd step 
    
    $result->bind_param("ss", $username, $password); 

    // 4th step 
    $result->execute(); 

    // 5th step 
    $result = $result->get_result(); 

     
    
    
    if($result->num_rows>=1)
    {

          $user_data = $result->fetch_assoc(); 
          
            var_dump($user_data);       
          
          $_SESSION['username'] = $user_data['username']; 
          $_SESSION['role'] = $user_data['role']; 

          if($user_data['role']=="admin")
          {
            // ADMIN PORTAL 
            
             // header('Location'.'dashboar.php')
              header('Location:'.BASE_URL_ADMIN.'dashboard.php'); 
          }
          else
          {
            // USER PORTAL 
            header('Location:'.BASE_URL_USER.'dashboard.php');
          }


    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link rel="stylesheet" href="../assets/css/user.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>

    <div class="user-form">
    <form method="POST" action=" login.php   ">
        <h4>Log in Complaint Management System</h4>
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit" name="submit">Login</button>
    
    </div>
    </form>
</body>
</html>
