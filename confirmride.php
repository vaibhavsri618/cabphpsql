<?php

require 'Dbconnect.php';
class confirm
{
    function confirm1($conn)
    {
if(isset($_GET['id']))
{
   $id=$_GET['id'];
  

    $sql = "UPDATE `tbl_ride` SET `status`=2 WHERE `ride_id`=".$id."";

    if ($conn->query($sql) === TRUE) {
    echo '<script type="text/javascript">; 
    alert("Approval Granted successfully"); 
    window.location= "admin.php";
    </script>';   
    } else {
    echo "Error updating record: " . $conn->error;
    }
}
}
}

$confirm =new confirm();
$connection=new Dbconnect();
$confirm->confirm1($connection->conn);
?>