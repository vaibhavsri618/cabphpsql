<?php 


include 'adminwork.php';
include 'header.php';


if(isset($_SESSION['userdata']['name']))
{
    if($_SESSION['userdata']['name']=="admin")
    {
 $id=$_SESSION['userdata']['userid'];


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

                <h2 style="text-align:center">Change Password:</h2>
              


                <?php
               
             
               
               
                   
               echo'
               <form action="user.php?id7='.$id.'" method="post">
               <label>Old Password :</label>
               <input type="password" id="nam2" name="oldpass"><br>
               <label>New Password :</label>
               <input type="password" id="mobile2" name="newpass"><br>
               <label>Confirm Password :</label>
               <input type="password" id="mobile3" name="conpass"><br>
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