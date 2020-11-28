<?php 

session_start();
include 'adminwork.php';

if(isset($_SESSION['userdata']['name']))
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

                <br>
                    <br>
                    <label>Sort By:</label>
                    <select id="select">
                        <option value="none">None</option>
                        <option value="user_id">Userid</option>
                        <option value="dateofsignup">Date</option>
                        <option value="name">Name</option>
                    </select>


                    <label style="float:right;margin-top:20px">Filter By Date:
                    <select id="filter" style="height:40px;width:100px">
                        <option value="none">None</option>
                        <option value="week">Week wise</option>
                      
                        <option value="month">Month Wise</option>

                        <option value="today">Today</option>
                       
                    </select></label>


                    <br>
                    <br>
                    <div id="res">

                    <table border="2px solid black">
    
                    <tr>
                    
                    <th>Userid</th>
                    <th>Email</th>
                    <th>Name</th>
                    <th>Date</th>
                    <th>Mobile No</th>
                    <th>Approve</th>
                    </tr>
                    <tbody>
                
                <?php
              

                $admin=new adminwork();
                $dbconnect=new Dbconnect();
                $row1=$admin->newuser($dbconnect->conn);

                foreach($row1 as $key=>$row)
                {




                        
                echo "<tr>";
                echo "<td>".$row['user_id']."</td>";
                echo "<td>".$row['user_name']."</td>";
                echo "<td>".$row['name']."</td>";
                echo "<td>".$row['dateofsignup']."</td>";
                echo "<td>".$row['mobile']."</td>";
                echo "<td><a href='confirmuser.php?id=".$row['user_id']."'>Yes</a> / <a href='#'>No</a></td>";
                        }

             
                  ?> 

                </div>
                </div>


              
                </div>
               
            </div>

        </div>

        <script>
            $(document).ready(function(){
            $("#select").change(function(){

               var text=$(this).val();
               var id=<?php echo $id?>
               
               console.log(text);

                    $.ajax({
                        type: 'post',
                        url: 'filteradmin.php',
                        data:{
                           id2:id,
                           text:text

                        },
                        success: function (answer) {
                        
                        $("#res").html(answer);
                        console.log(answer);
        },
        
      });



            });



        $("#filter").change(function(){

        var value=$(this).val();
        var id=<?php echo $id?>

        $.ajax({
                type: 'post',
                url: 'filteradmin.php',
                data:{
                id10:id,
                value:value

                },
                success: function (answer) {
                
                $("#res").html(answer);
                console.log(answer);
        },

        });


});

        });
        </script>
   
    </body>
</html>
<?php

            }
            else
            echo 'Please Login,first to continue <a href="login2.php">Click here to login</a>';
?>