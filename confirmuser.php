<?php

require 'Dbconnect.php';
class confirm
{
    function confirm1($conn)
    {
if(isset($_GET['id']))
{
   $id=$_GET['id'];
    date_default_timezone_set("Asia/Calcutta");

    $date=date("Y-m-d h:i:s");

    $sql = "UPDATE tbl_user SET isblock=1 , dateofsignup='".$date."' WHERE user_id=".$id."";

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