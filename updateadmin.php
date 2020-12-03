<?php 


include 'adminwork.php';
include 'header.php';


if(isset($_SESSION['userdata']['name']))
{

    if($_SESSION['userdata']['name']=="admin")
{
 $id=$_SESSION['userdata']['userid'];


?>



<html>
    <head>
        <title>Admin</title>
    </head>
    <link rel="stylesheet" type="text/css" href="styleadmin.css"> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
    <body>
        <div class="main">
            <div id="asider">
                <h3 style="color:white">Hello Admin</h3>

                <ul>
                    <li class="li"><a href="admin.php">Dashboard</a></li>
                  

                    <li class="li"><a href="#">View User</a>
                    <ul class="ul">
                    <li class="li"><a href="viewnewuser.php">View New/Block User
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
                    Completed</a></li>
                    <li class="li"><a href="allrideadmin.php"
                    >All Rides</a></li></ul></li>
              


                    <li class="li"><a href="#">Location</a>
                    <ul class="ul">
                    <li class="li"><a href="addlocation.php">Add new Location
                    </li>
                   
                    <li class="li"><a href="viewlocation.php">
                    View Location</a></li></ul></li>

                    <li class="li"><a href="#">Profile</a>
                    <ul class="ul">
                    <li class="li"><a href="updateadmin.php">
                    update</li>
                   
                    <li class="li"><a href="changeadminpass.php"
                    >Change Password</a></li>
                    </ul></li>
                  
                  
                    

                  
                   
                  
                    

                </ul>

            </div>
            <div class="container"> 
              

                
              


                <div class="section">


                <h2 style="text-align:center">Update Profile:</h2>
              



                <?php
                $can="";
                $user=new adminwork();
                $dbconnect=new Dbconnect();
                $row1=$user->updateadmin($id,$dbconnect->conn);
                $obj=$dbconnect->conn;
                $total=0;

                foreach($row1 as $key=>$row)
                {
                   
                    echo  '
                    <form action="user.php?id6='.$id.'" method="post">
                    <label>Name :</label>
                    <input type="text" id="nam" name="name" value="'.$row["name"].'" readonly><br>
                    <label>Phone :</label>
                    <input type="text" id="mobile" name="mobile" value="'.$row["mobile"].'"><br>
                    <input type="submit" id="up" name="update2" value="Update"><br>
                   
                    
                    
                    ';

                    
                   
                }
                  ?> 
                 
                </div>


            </div>

        </div>
        <script src="cab.js"></script>
    </body>
</html>
<?php
  }
  else
  {
  echo '<script type="text/javascript">; 
  alert("You cant access admin profile"); 
  window.location= "login2.php";
  </script>';
  }
}
else
{
    echo 'Please Login,first to continue <a href="login2.php">Click here to login</a>';
}
?>


