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
                  

                    <a href="#"><li class="li">View User</a>
                    <ul class="ul">
                   <a href="viewnewuser.php"><li class="li">View New/Block User
                    </li></a>
                    <a href="approveduser.php"><li class="li">View Approved User
                    </li></a>
                   
                    <a href="alluser.php"><li class="li">
                    All User</li></a></ul></li>

                    <li class="li"><a href="#">View Ride Request</a>
                    <ul class="ul">
                    <a href="newrequest.php"><li class="li">
                    New Request</li></a>
                    <a href="cancelride.php"
                    ><li class="li">Cancelled</li></a>
                    <a href="completeride.php"><li class="li">
                    Completed</li></a>
                    <a href="allrideadmin.php"
                    ><li class="li">All Rides</li></a></ul></li>
              


                    <li class="li"><a href="#">Location</a>
                    <ul class="ul">
                    <a href="addlocation.php"><li class="li">Add new Location
                    </li></a>
                   
                    <a href="viewlocation.php"><li class="li">
                    View Location</li></a></ul></li>

                    <li class="li"><a href="#">Profile</a>
                    <ul class="ul">
                    <a href="updateadmin.php"><li class="li">
                    update</li></a>
                   
                    <a href="changeadminpass.php"
                    ><li class="li">Change Password</li></a>
                    </ul></li>
                  
                    

                  
                   
                  
                    

                </ul>


            </div>
            <div class="container"> 
              

                <div class="section">

                <h2 style="text-align:center">New Rides Request:</h2><br>
              

            
                    <label>Sort By:</label>
                    <select id="select">
                        <option value="none">None</option>
                        <option value="total_distance">Distance</option>
                        <option value="ride_date">Date</option>
                        <option value="total_fare">Fare</option>
                    </select>

                    <label style="float:right;margin-top:20px">Filter By Date:
                    <select id="filter" style="height:40px;width:100px">
                        <option value="none">None</option>
                        <option value="week">Week wise</option>
                      
                        <option value="month">Month Wise</option>

                        <option value="today">Today</option>
                       
                    </select></label>



                    <label style="float:right;margin-top:20px;margin-right:10px">Filter By Cab Type:
                    <select id="filtercar" style="height:40px;width:100px">
                        <option value="none">None</option>
                        <option value="cedmicro">CedMicro</option>
                      
                        <option value="cedmini">CedMini</option>

                        <option value="cedroyal">CedRoyal</option>
                        <option value="cedsuv">CedSuv</option>
                       
                    </select></label>

                    <br>
                    <br>
                    <div id="res">

                    <table border="2px solid black" style="margin-right:10px">
    
                    <tr>
                    
                    <th>Rideid</th>
                    <th>Date</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Total Distance</th>
                    <th>Luggage</th> 
                    <th>Fare</th>
                    <th>Cid</th>
                    <th>Car</th>
                    <th>Approve</th>
                    <th>View</th>
                    </tr>
                    <tbody>
                
                <?php

                $admin=new adminwork();
                $dbconnect=new Dbconnect();
                $row1=$admin->newride($dbconnect->conn);

                foreach($row1 as $key=>$row7)
                {
                    if($row7['luggage']=="")
                    $luggage=0;
                    else
                    $luggage=$row7['luggage'];

                    echo "<tr>";
                    echo "<td>".$row7['ride_id']."</td>";
                    echo "<td>".$row7['ride_date']."</td>";
                    echo "<td>".$row7['from_distance']."</td>";
                    echo "<td>".$row7['to_distance']."</td>";
                    echo "<td>".$row7['total_distance']."</td>"; 
                    echo "<td>".$luggage."</td>";
                    echo "<td>".$row7['total_fare']."</td>";
                    echo "<td>".$row7['customer_user_id']."</td>";
                    echo "<td>".$row7['car']."</td>";
                    echo "<td><a href='confirmride.php?id=".$row7['ride_id']."'>Yes</a> / 
                    <a href='adminwork.php?id3=".$row7['ride_id']."'>No</a></td>";
                    echo "<td><a href='invoice.php?id54=".$row7['customer_user_id']."&rid=".$row7['ride_id']."'>Invoice</a></td>";
                  
            




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
                           id4:id,
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
                           id7:id,
                           value:value

                        },
                        success: function (answer) {
                        
                        $("#res").html(answer);
                        console.log(answer);
        },
        
      });


            });


$("#filtercar").change(function(){

var value=$(this).val();
var id=<?php echo $id?>

$.ajax({
        type: 'post',
        url: 'filteradmin.php',
        data:{
        id33:id,
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
      {
      echo '<script type="text/javascript">; 
      alert("You cant access admin profile"); 
      window.location= "login2.php";
      </script>';
      }
            }
            else
            echo 'Please Login,first to continue <a href="login2.php">Click here to login</a>';
?>