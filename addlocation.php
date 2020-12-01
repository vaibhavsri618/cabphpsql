<?php 

session_start();



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
                echo '<a href="Logout.php" id="a">Logout</a>';
                if (isset($_SESSION['userdata'])) {
                    echo "<h1 style='margin:10px 0px 0px 35%'>Welcome 
                        ".$_SESSION["userdata"]["username"]."</h1>";
                }
                ?>

                <div class="section">
                
                <?php
                include 'adminwork.php';

                ?>

                <form action="#" method="post">
                <h2 id="dl">Add Drop Location</h2>
                <label> Drop Location: </label>
                <input type="text" name="drop" placeholder="drop" id="drop" require><br>
                <label> Distance: </label>
                <input type="number" placeholder="distance" name="distance" id="distance"><br>
                <label> Stop: </label>
                <input type="radio"  name="stop" id="stop" value="1">Yes

                <input type="radio" name="stop" id="stop1" value="0">No<br>

                <input type="submit" name="btnsubmit" value="submit" id="btnsubmit">
              
              
              
                </form>
                <?php

                    if(isset($_POST['btnsubmit']))
                    {
                        if(isset($_POST['stop']) && isset($_POST['drop']))
                        {
                       
                        $drop=$_POST['drop'];
                        $distance=$_POST['distance']; 
                        $radio=$_POST['stop'];
                    
                     
                    

                $admin=new adminwork();
                $dbconnect=new Dbconnect();
                $admin->addlocation($drop,$distance,$radio,$dbconnect->conn);
                    }
                    else
                    {
                    echo "<script>alert('Field cant be null')</script>";
                    }
                }
                  ?> 

                </div>


              
                </div>
               
            </div>

        </div>
    </body>
</html>