<?php

require 'Dbconnect.php';


session_start();
require 'header1.php';

if($_SESSION['userdata']['name']=="admin")
{


$expire=600;
if(isset($_SESSION['timeout']))
{
if(time()-$_SESSION['timeout'] >$expire)
{
  
 
  echo '<script type="text/javascript">; 
alert("Session timeout"); 
window.location= "Logout.php";
</script>';

}
else
{
  $_SESSION['timeout']=time();
}

}
else
{
$_SESSION['timeout']=time();
}



?>



<html>
    <head>
        <title>Admin</title>
    </head>
    <link rel="stylesheet" type="text/css" href="styleadmin.css">  
    <body>
        <div class="main">
            <div id="asider">
                <h3 style="color:white">Hello Admin</h3>

                <ul>
                    <li class="li"><a href="admin.php">Dashboard</a></li>
                  

                    <li class="li"><a href="#">View User</a>
                    <ul class="ul">
                    <li class="li"><a href="viewnewuser.php">View New User
                    </li>
                    <li class="li"><a href="approveduser.php">View Approved User
                    </li>
                   
                    <li class="li"><a href="alluser.php">
                    All User</a></li></ul></li>

                    <li class="li"><a href="#">View Ride Request</a>
                    <ul class="ul">
                    <li class="li"><a href="newrequest.php">
                    New Request</li>
                    <li class="li"><a href="cancelride.php"
                    >Cancelled</li>
                    <li class="li"><a href="completeride.php">
                    Completed</a></li></ul></li>
              


                    <li class="li"><a href="#">Location</a>
                    <ul class="ul">
                    <li class="li"><a href="addlocation.php">Add new Location
                    </li>
                   
                    <li class="li"><a href="viewlocation.php">
                    View Location</a></li></ul></li>
                    

                  
                   
                    

                </ul>

            </div>
            <div class="container"> 
                <?php
               
                if (isset($_SESSION['userdata'])) {
                   




                class confirm
                {
                    function confirm1($conn)
                    {
                if(isset($_GET['id']))
                {
                $id=$_GET['id'];

                    $sql = "SELECT * FROM tbl_location WHERE id=".$id."";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        echo ' <form action="#" method="post">
                        <h2 id="dl">Add Drop Location</h2>';
                    while($row = $result->fetch_assoc()) {

                       ?>
                    
                        <label> Drop Location: </label>
                        <input type="text" name="drop" placeholder="drop" id="drop1" pattern="^[a-zA-Z_]+( [a-zA-Z_]+)*$" value="<?php echo $row['name']?>"><br>
                        <label> Distance: </label>
                        <input type="number" placeholder="distance" name="distance" id="distance1" value="<?php echo $row['distance']?>"><br>
                        <label> Stop: </label>
                      
                        <input type="radio"  name="stop" id="stop" value="1"<?php echo($row['is_available']==1)?'checked':''?>>Yes
                    
                        <input type="radio" name="stop" id="stop1" value="0"<?php echo($row['is_available']==0)?'checked':''?>>No<br>
                    
                        <input type="submit" name="btnsubmit" value="Update" id="btnsubmit">
                    
                    
                    
                    <?php
                    
  
                        
                    }
                    
                    echo '</form>';
                    
                    } else {
                    echo "0 results";
                    }


                        if(isset($_POST['btnsubmit']))
                        {
                            $error=array();
                            $drop=$_POST['drop'];
                            $distance=$_POST['distance'];
                            $stop=$_POST['stop'];


                            $sql1 = "SELECT * FROM tbl_location WHERE name='".$drop."' AND `id`!='".$id."'";
                            $result = $conn->query($sql1);
                    
                            if ($result->num_rows > 0) {
                                $error[] = array(
                                    "id" => 'form',
                                    'msg' => "Location all ready exist"
                                );
                            }

                            if(count($error)==0)

                            {


                            $sql4 = "UPDATE `tbl_location` SET `name`='".$drop."' , `distance`='".$distance."' , `is_available`='".$stop."' WHERE `id`=".$id."";

                            if ($conn->query($sql4) === TRUE) {
                            echo '<script type="text/javascript">; 
                            alert("Location Updated Successfully"); 
                            window.location= "viewlocation.php";
                            </script>';   
                            } else {
                            echo "Error updating record: " . $conn->error;
                            }


                        } else{

                            foreach($error as $err)
                            {
                                echo "<p style='color:red'>".$err['msg']."</p>";
                            }
                        }

                        }
                

                }
                }
                }

                $confirm =new confirm();
                $connection=new Dbconnect();
                $confirm->confirm1($connection->conn);
              


                                }
                                
                                ?>

                            </div>

                        </div>
                    </body>
                </html>


<?php

}
else
{
echo '<script type="text/javascript">; 
alert("You cant access admin profile"); 
window.location= "Logout.php";
</script>';
}

?>