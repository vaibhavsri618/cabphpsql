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

                   
                    <br>
                    <br>
                    <div id="res">

                 <table border="2px solid black">
    
                    <tr>
                    
                    <th>Rideid</th>
                    <th>Date</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Distance</th>
                    <th>Luggage</th> 
                    <th>Customer id</th> 
                    <th>Car</th> 
                  
                    <th>Total Fare</th>   

                    
                   
                  
                    </tr>
                    <tbody>


                <?php
                $admin=new adminwork();
                $dbconnect=new Dbconnect();
                $row1=$admin->completeride($dbconnect->conn);

                    $total=0;
             

                foreach($row1 as $key=>$row)
                {


                    if($row['luggage']=="")
                    $luggage=0;
                    else
                    $luggage=$row['luggage'];

                    echo        "<tr>";
                    echo "<td>".$row['ride_id']."</td>";
                    echo "<td>".$row['ride_date']."</td>";
                    echo "<td>".$row['from_distance']."</td>";
                    echo "<td>".$row['to_distance']."</td>";
                    echo "<td>".$row['total_distance']."</td>";
                    echo "<td>".$luggage."</td>";  
                
                    echo "<td>".$row['customer_user_id']."</td>";
                    echo "<td>".$row['car']."</td>";
                    echo "<td>".$row['total_fare']."</td>"; 

                    $total=$total+$row['total_fare'];
     
     
       
                }
                ?> 
                <tr><th colspan='8'>Your total Earning till now</th>
                <th><?php echo $total ?></th>
              </tr>
                 

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
                           id6:id,
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
        id9:id,
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
    echo 'Please Login,first to continue <a href="login2.php">Click here to login</a>';
}

?>