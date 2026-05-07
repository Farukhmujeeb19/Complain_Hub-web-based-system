<?php
session_start();
require_once('../includes/connection.php');
require_once('../includes/base_urls.php');

if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header('Location: ' . BASE_URL_ADMIN . 'login.php');
    exit;
}


















// FIRST STEP TO WRITE SQL QUERY 
$sql = "SELECT * FROM complaints";

// SECOND STEP TO PREPARE YOUR QUERY 

$result = $conn->prepare($sql);

// execute your query 
$result->execute(); 
// at last we get all the data in $result 
$result = $result->get_result(); 


// print_r("<pre>"); 

// print_r($result); 

// print_r("</pre>"); 

?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>
    

    <div class="header">

      <h1>All complaints</h1>
      <h2>Admin Dashboard</h2>
    </div>

    <div class="admin-dashboard">

        <table border = "1">

            <thead>

                <th>S.No</th>
                <th>ID</th>
                <th>Username</th>
                <th>Comaplaint type</th>
                <th>Complaint subject</th>
                <th>File picture</th>
            </thead>

            <?php $i = 0; while($row = $result->fetch_assoc()  ){ $i++;?> 


                <tr>

                    <td>
                        <?php echo $i;  ?> 
                    </td>
                    
                    <td>
                        <?php echo $row['id'];  ?> 
                    </td>
                    <td>
                        <?php echo $row['username'];  ?> 
                    </td>

                    <td>
                        <?php echo $row['type'];  ?> 
                    </td>

                    <td>
                        <?php echo $row['subject'];  ?> 
                    </td>

                    
                    <td>
                    <a href="../uploads/<?php echo $row['file']; ?> ">    <img src="../uploads/<?php echo $row['file'] ?> " width="80px" alt=""> </a> 
                    </td>

                    <td>
     <a href="delete.php?id=<?php echo $row['id']; ?>&action=approve">Delete</a>
                    </td>
                
                </tr>




            <?php   } ?> 
        </table>
    </div>
    

      

    

</body>
</html>




















































 

















