<?php 

include ('header.php');
include 'adminwork.php';
if(isset($_SESSION['userdata']['userid']))
{

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
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
               

      
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main">

  <!-- Header -->
  <header class="w3-container" style="padding-top:22px">
  
  </header>

  <div class="w3-row-padding w3-margin-bottom">
    <div class="w3-quarter">
      <div class="w3-container w3-blue w3-padding-16">
        <div class="w3-left"><i class="fa fa-users w3-xxxlarge"></i></div>
        <div class="w3-right">

        <?php
            $admin=new adminwork();
            $dbconnect=new Dbconnect();
            $len=$admin->countnewrequest($dbconnect->conn);
            echo '<h3>'.$len.'</h3>';
        ?>
         
        </div>
        <div class="w3-clear"></div>
        <a href="viewnewuser.php">
        <h4>New User Request</h4>
        </a>        
      </div>
    </div>

    <div class="w3-quarter">
      <div class="w3-container w3-red w3-padding-16">
        <div class="w3-left"><i class="fa fa-taxi w3-xxxlarge"></i></div>
        <div class="w3-right">
        
        <?php
            $admin=new adminwork();
            $dbconnect=new Dbconnect();
            $len=$admin->countnewriderequest($dbconnect->conn);
            echo '<h3>'.$len.'</h3>';
        ?>
         
        </div>
        <div class="w3-clear"></div>
        <a href="newrequest.php">
        <h4>New Ride Request</h4>
        </a>
      </div>
    </div>
    <div class="w3-quarter">
      <div class="w3-container w3-red w3-padding-16">
        <div class="w3-left"><i class="fa fa-taxi w3-xxxlarge"></i></div>
        <div class="w3-right">
        <?php
            $admin=new adminwork();
            $dbconnect=new Dbconnect();
            $len=$admin->countcancelriderequest($dbconnect->conn);
            echo '<h3>'.$len.'</h3>';
        ?>
        </div>
        <div class="w3-clear"></div>
        <a href="cancelride.php">
        <h4>Cancel ride</h4>
        </a>        
      </div>
    </div>
    <div class="w3-quarter">
      <div class="w3-container w3-blue w3-text-white w3-padding-16">
        <div class="w3-left"><i class="fa fa-users w3-xxxlarge"></i></div>
        <div class="w3-right">
        <?php
            $admin=new adminwork();
            $dbconnect=new Dbconnect();
            $len=$admin->countalluserrequest($dbconnect->conn);
            echo '<h3>'.$len.'</h3>';
        ?>
        </div>
        <div class="w3-clear"></div>
        <a href="alluser.php">
        <h4>All users</h4>
        </a>
      </div>
    </div>
    <div class="w3-quarter" style="margin-top:20px">
      <div class="w3-container w3-blue w3-padding-16">
        <div class="w3-left"><i class="fa fa-users w3-xxxlarge"></i></div>
        <div class="w3-right">

        <?php
            $admin=new adminwork();
            $dbconnect=new Dbconnect();
            $len=$admin->countoldrequest($dbconnect->conn);
            echo '<h3>'.$len.'</h3>';
            ?>
          
        </div>
        <div class="w3-clear"></div>
        <a href="approveduser.php">
        <h4>Confirm Users</h4>
        </a>        
      </div>
    </div>

    <div class="w3-quarter" style="margin-top:20px">
      <div class="w3-container w3-red w3-padding-16">
        <div class="w3-left"><i class="fa fa-taxi w3-xxxlarge"></i></div>
        <div class="w3-right">
        <?php
            $admin=new adminwork();
            $dbconnect=new Dbconnect();
            $len=$admin->countcompleteriderequest($dbconnect->conn);
            echo '<h3>'.$len.'</h3>';
        ?>
        </div>
        <div class="w3-clear"></div>
        <a href="completeride.php">
        <h4>Completed Rides</h4>
        </a>
      </div>
    </div>

    <div class="w3-quarter" style="margin-top:20px">
      <div class="w3-container w3-teal w3-padding-16">
        <div class="w3-left"><i class="fa fa-map-marker w3-xxxlarge"></i></div>
        <div class="w3-right">
        <?php
            $admin=new adminwork();
            $dbconnect=new Dbconnect();
            $len=$admin->countlocationrequest($dbconnect->conn);
            echo '<h3>'.$len.'</h3>';
        ?>
        
        </div>
        <div class="w3-clear"></div>
        <a href="viewlocation.php">
        <h4> Location</h4>
        </a>        
      </div>
    </div>

    <div class="w3-quarter" style="margin-top:20px">
      <div class="w3-container w3-orange w3-text-white w3-padding-16">
        <div class="w3-left"><i class="fa fa-money w3-xxxlarge"></i></div>
        <div class="w3-right">
        <?php
            $admin=new adminwork();
            $dbconnect=new Dbconnect();
            $len=$admin->counttotalearning($dbconnect->conn);
            echo '<h3>	&#x20B9;'.$len.'</h3>';
        ?>
        </div>
        <div class="w3-clear"></div>
        <a href="completeride.php">
        <h4>Total Earning</h4>
        </a>
      </div>
    </div>


  </div>
  
  </div>

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
  window.location= "Logout.php";
  </script>';
  }

}


else
{
    echo 'Please Login,first to continue <a href="login2.php">Click here to login</a>';
}

?>