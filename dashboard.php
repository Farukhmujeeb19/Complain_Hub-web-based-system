<?php
session_start();
require_once('../includes/connection.php');
require_once('../includes/base_urls.php');

if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header('Location: ' . BASE_URL_ADMIN . 'login.php');
    exit;
}


$sql = " SELECT * FROM complaints"; 

$result = $conn->prepare($sql); 

$result->execute(); 

$result = $result->get_result(); 


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
    
</head>

<body>

    <div class="header">
        <h1>Admin Dashboard</h1>
        <h2>All Complaints</h2>
    </div>

    <div class="admin-dashboard">
        <table border="1">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Subject</th>
                    <th>Complaint Type</th>
                    <th>Details</th>
                    <th>Status</th>
                    <th>PIcture</th>
                    <th>Action</th>
                </tr>
            </thead>


            <?php while($row = $result->fetch_assoc()) { ?>

                <tr> 
                     <td>  <?php  echo $row['username'];   ?>   </td>
                     <td>  <?php  echo $row['subject'];   ?>   </td>
                     <td>  <?php  echo $row['type'];   ?>   </td> 
                     <td>  <?php  echo $row['detail'];   ?>   </td>
                     <td>  <?php  echo $row['status'];   ?>   </td>

                    
            <td> <a href="../uploads/<?php echo $row['file'] ?>" target="_blank"> <img src="../uploads/<?php echo $row['file']; ?>" width="60px" height="60px" alt=""> </a> </td>


            <td>  <a href="approve_complaint.php?id=<?php echo $row['id'];?>&action=approve">Approve</a> </td> 

                </tr> 

          
            <?php }?>
        </table>
    </div>

    
</body>

</html>
