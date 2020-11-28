<?php

require 'Dbconnect.php';
class confirm
{
    function confirm1($conn)
    {
if(isset($_GET['id']))
{
   $id=$_GET['id'];
  

   $sql = "DELETE FROM tbl_location WHERE id=".$id."";

if ($conn->query($sql) === TRUE) {
    echo '<script type="text/javascript">; 
    alert("Deleted successfully"); 
    window.location= "admin.php";
    </script>';   
} else {
  echo "Error deleting record: " . $conn->error;
}

}
}
}

$confirm =new confirm();
$connection=new Dbconnect();
$confirm->confirm1($connection->conn);
?>