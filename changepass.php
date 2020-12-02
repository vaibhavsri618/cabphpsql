<?php 

include 'user.php';

include 'header1.php';

if(isset($_SESSION['userdata']['username']))
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
                
             

               


                <?php
               
             
               
               
                   
                    echo'
                    <form action="user.php?id7='.$id.'" method="post">
                    <label>Old Password :</label>
                    <input type="password" id="nam2" name="oldpass"><br>
                    <label>New Password :</label>
                    <input type="password" id="mobile2" name="newpass"><br>
                    <label>Confirm Password :</label>
                    <input type="password" id="mobile" name="conpass"><br>
                    <input type="submit" id="up" name="update3" value="Update"><br>
                   
                    
                    
                    ';


                 
                   
                
                  ?> 
                 
                </div>


            </div>

        </div>
   
    </body>
</html>
<?php
}
else
{
    echo 'Please Login,first to continue <a href="login2.php">Click here to login</a>';
}
?>