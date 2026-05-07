<?php
session_start();
require_once('../includes/connection.php');
require_once('../includes/base_urls.php');

if (!isset($_SESSION['username']) || $_SESSION['role']!='user' ) {
    header('Location: ' . BASE_URL_USER . 'login.php');
    exit;
}

    if( isset( $_SESSION['success_message']  ) )
    {

    echo "<div style = 'background-color:green; color:white;margin-top:25%;text-align:center'> ".$_SESSION['success_message']. "</div>"; 
    
    unset($_SESSION['success_message']); 
    
    }


    $current_user = $_SESSION['username']; 

    
    $sql = "SELECT *FROM complaints WHERE username = ?"; 

    $result = $conn->prepare($sql );
    
    
    $result->bind_param("s", $current_user);

    $result->execute(); 

    $result = $result->get_result(); 

    // we get data but the type of $result is object

    //$current_user = $_SESSION


?> 



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>

    <link rel="stylesheet" href="../assets/css/user_dashboard.css">
</head>
<body>


    
    <h1> Welcome,  <?php echo $_SESSION['username'] ; ?>  </h1>

    <?php  echo "<h1>welcome</h1>" ?> 

    <h2>Your Complaints</h2>
    <table border="1">

        <!-- html tempate static --> 
        <tr>
            <th>Subject</th>
            <th>Complaint Type</th>
            <th>Details</th>
            <th>Status</th>
            <th>File </th>
        </tr>

        <!-- Fetch Assoc will convert to key value form --> 
        <?php while($row = $result->fetch_assoc()) {?> 


            <tr> 
                <td> <?php echo  $row['subject']; ?> </td>      
                <td> <?php echo  $row['type'] ;?>    </td>
                <td> <?php echo $row['detail'];?>  </td>
                <td> <?php echo $row['status'];?>  </td>
                <td> <a href="../uploads/<?php echo $row['file'];?>" target="_blank"> <img src="../uploads/<?php echo $row['file'];?>" width="60px" height="60px" alt="">    </td>

            </tr> 

        <?php }?>
    
    </table>

   <!-- GUI Form for submitting complaint --> 


   <h2>Submit a Complaint </h2>

   <form action="complaint.php" method="POST" enctype="multipart/form-data">

        <input type="text" name="subject" placeholder="subject">

        <select name="type" id="">
            <option value="readdressal">Readdressal</option>
            <option value="grievance">Grievance</option>
        </select>
   
        <textarea name="detail" id=""></textarea>
        <input type="file" name="file">

 
        <button type="submit" name="submit">Submit</button>
   </form>


</body>
</html>
