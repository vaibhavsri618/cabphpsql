<?php 

include 'user.php';
include 'header1.php';

if(isset($_SESSION['userdata']['username']))
{
    if($_SESSION['userdata']['name']!="admin")
    {
$id=$_SESSION['userdata']['userid'];

?>



<html>
    <head>
        <title>User</title>
    </head>
    <link rel="stylesheet" type="text/css" href="styleadmin.css">
    <body>
        <div class="main">
            <div id="asider">
                <h3 style="color:white">Hello <?php echo $_SESSION["userdata"]["name"] ?></h3>

                <ul>
                    <li class="li"><a href="homeuser.php">Dashboard</li>
                    <li class="li"><a href="bookride.php">Book a Ride </li>
                    <li class="li"><a href="#">Rides</a>
                    <ul class="ul">
                    <li class="li"><a href="pendingride.php">
                    Pending Rides</li>
                    <li class="li"><a href="completeduserride.php"
                    >Completed Rides</li>
                    <li class="li"><a href="canceluserride.php"
                    >Cancel Rides</li> 
                    <li class="li"><a href="allride.php"
                    >All Rides</li>
                    </ul></li>
                    
                  
                  
                    <li class="li"><a href="#">Profile</a>
                    <ul class="ul">
                    <li class="li"><a href="updateuser.php">
                    update</li>
                   
                    <li class="li"><a href="changepass.php"
                    >Change Password</a></li>
                    </ul></li>
                  
                   
                    

                </ul>

            </div>
            <div class="container"> 
              
             

                <div class="section">
                

                <h2 style="text-align:center">Update Profile:</h2>
                

             


                <?php
                $can="";
                $user=new user();
                $dbconnect=new Dbconnect();
                $row1=$user->updateuser($id,$dbconnect->conn);
                $obj=$dbconnect->conn;
                $total=0;

                foreach($row1 as $key=>$row)
                {
                   
                    echo  '
                    <form action="user.php?id6='.$id.'" method="post">
                    <label>Name :</label>
                    <input type="text" id="nam" name="name" value="'.$row["name"].'"><br>
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