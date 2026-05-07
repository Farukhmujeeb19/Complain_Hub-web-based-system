<?php 
session_start();

// any issue in connection file, so i will get fatal error and my whole script will 
// be not executed as well
require_once('includes/connection.php');
require_once('includes/base_urls.php');


if(isset($_POST['submit']))
{

    $username =   $_POST['username'];


   

    // if i want to store in encrypted form, then i will use hash. 
    // so be careful about storing password in DB
    $password = $_POST['password']; 
    $role = "user"; 

    if($username=="admin" && $password=="123")
    {

        $role = "admin"; 
    }

    // 1st step 
    $sql = " INSERT INTO users (username, password, role) VALUES(?, ?, ?) "; 


    // 2nd step 

    $result = $conn->prepare($sql);
   
    

    // 
    
    $query_reuslt = $result->bind_param( "sss", $username, $password, $role );


    

    
    // 4th step 

    if($result->execute())
    {


        
    // 3rd step 
    
        // so it will automatically go to login.php 
        // similarly anchor tag <a></a> can work as well but it needs user click 
        header('Location:'.BASE_URL_USER.'login.php'); 
    }
            










} // end point 


?> 




<!-- GUI Form in html --> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/user.css">

</head>

<body>

    <div class="user-form">
    <h4>Register </h4>
    <form method="POST" action="<?php $_SERVER['PHP_SELF']  ?> "  > 
    
        
        <input type="text" name="username" placeholder="Username" ><br>
        <input type="password" name="password" placeholder="Password" ><br>
        <button type="submit" name="submit">Register in System</button>
    
    </form>
    <br>
    <button> <a href="user/login.php" >Already registered </a></button>
    </div>
</body>
</html>
