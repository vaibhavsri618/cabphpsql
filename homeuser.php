<?php 



include 'user.php';

if(isset($_SESSION['userdata']['username']))
{

    $id=$_SESSION['userdata']['userid'];

?>



<html>
    <head>
        <title>User</title>
    </head>
    <link rel="stylesheet" type="text/css" href="styleadmin.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  
    <body>
        <div class="main">
            <div id="asider">
                <h3 style="color:white">Hello <?php echo $_SESSION["userdata"]["name"] ?></h3>

                <ul>
                    <li class="li">Dashboard</li>
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
                    <li class="li"><a href="completeduserride.php">Check how much you have spend on our ride </li>
                    
                  
                  
                    <li class="li"><a href="#">Profile</a>
                    <ul class="ul">
                    <li class="li"><a href="updateuser.php">
                    update</li>
                   
                    <li class="li"><a href="changepass.php"
                    >Change Password</li>
                    </ul></li>
                  
                   
                    

                </ul>

            </div>
            <div class="container"> 
                <?php
                echo '<a href="Logout.php" id="a">Logout</a>';
                if (isset($_SESSION['userdata'])) {
                    echo "<h1 style='margin:10px 0px 0px 25%'>Welcome 
                        ".$_SESSION["userdata"]["username"]."</h1>";
                }
                
                ?>

<div class="w3-row-padding w3-margin-bottom">
    <div class="w3-quarter">
      <div class="w3-container w3-blue w3-padding-16">
        <div class="w3-left"><i class="fa fa-taxi w3-xxxlarge"></i></div>
        <div class="w3-right">

        <?php
            $admin=new user();
            $dbconnect=new Dbconnect();
            $len=$admin->countnewrequest($id,$dbconnect->conn);
            echo '<h3>'.$len.'</h3>';
        ?>
         
        </div>
        <div class="w3-clear"></div>
        <a href="completeduserride.php">
        <h4>Completed Rides</h4>
        </a>        
      </div>
    </div>

    <div class="w3-quarter">
      <div class="w3-container w3-blue w3-padding-16">
        <div class="w3-left"><i class="fa fa-taxi w3-xxxlarge"></i></div>
        <div class="w3-right">
        
        <?php
            $admin=new user();
            $dbconnect=new Dbconnect();
            $len=$admin->countnewriderequest($id,$dbconnect->conn);
            echo '<h3>'.$len.'</h3>';
        ?>
         
        </div>
        <div class="w3-clear"></div>
        <a href="pendingride.php">
        <h4>Pending Ride</h4>
        </a>
      </div>
    </div>

    <div class="w3-quarter">
      <div class="w3-container w3-orange w3-text-white w3-padding-16">
        <div class="w3-left"><i class="fa fa-money w3-xxxlarge"></i></div>
        <div class="w3-right">
        <?php
            $admin=new user();
            $dbconnect=new Dbconnect();
            $len=$admin->counttotalearning($id,$dbconnect->conn);
            echo '<h3>	&#x20B9;'.$len.'</h3>';
        ?>
        </div>
        <div class="w3-clear"></div>
        <a href="completeduserride.php">
        <h4>Total Spending</h4>
        </a>
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
    echo 'Please Login,first to continue <a href="login2.php">Click here to login</a>';
}
?>