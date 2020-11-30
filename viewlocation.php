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
                echo '<a href="Logout.php" id="a">Logout</a>';
                if (isset($_SESSION['userdata'])) {
                    echo "<h1 style='margin:10px 0px 0px 35%'>Welcome 
                        ".$_SESSION["userdata"]["username"]."</h1>";
                }
                ?>

                <div class="section">


               <table border="2px solid black" style="margin:20px">
    
                    <tr>
                    
                    <th>Locationid</th>
                    <th>Name</th>
                    <th>Distance</th>
                    <th>Stop</th>
                    <th>Action1</th>
                    <th>Action2</th>
                
                    </tr>
                    <tbody>
                
                <?php
                include 'adminwork.php';

                $admin=new adminwork();
                $dbconnect=new Dbconnect();
                $row1=$admin->viewlocation($dbconnect->conn);

                foreach($row1 as $key=>$row8)
                {

                    echo "<tr>";
                    echo "<td>".$row8['id']."</td>";
                    echo "<td>".$row8['name']."</td>";
                    echo "<td>".$row8['distance']."</td>";
                    echo "<td>".$row8['is_available']."</td>";
                  
                    echo "<td><a href='deletelocation.php?id=".$row8['id']."'>Delete</a></td>
                    <td><a href='updatelocation.php?id=".$row8['id']."'>Update</a></td>";
            
            


                }


                    echo '</tbody>
                    </table>'; 
                            
                  ?> 

                </div>


              
                </div>
               
            </div>

        </div>
    </body>
</html>