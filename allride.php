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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  
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

            <div class="section">
                
                <?php
         
                ?>

                    <br>
                    <br>
                    <label>Sort By:</label>
                    <select id="select">
                        <option value="none">None</option>
                        <option value="total_fare">Fare</option>
                        <option value="total_distance">Distance</option>
                        <option value="ride_date">Date</option>
                    </select>



                    <label style="float:right;margin-top:20px">Filter By Date:
                    <select id="filter" style="height:40px;width:100px">
                        <option value="none">None</option>
                        <option value="week">Week wise</option>
                      
                        <option value="month">Month Wise</option>

                        <option value="today">Today</option>
                       
                    </select></label>




                    <label style="float:right;margin-top:20px;margin-right:20px">Filter By Cab Type:
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

                 <table border="2px solid black">
    
                    <tr>
                    
                    <th>Ride Date</th>
                    <th>Pick Up Point</th>
                    <th>Drop Point</th>
                    <th>Total Distance</th>
                    <th>Luggage</th>
                    <th>Total Fare</th> 
                    <th>Car</th> 
                   
                  
                    </tr>
                    <tbody>


                <?
                $can="";
                $user=new user();
                $dbconnect=new Dbconnect();
                $row1=$user->allride($id,$dbconnect->conn);
                $obj=$dbconnect->conn;

                foreach($row1 as $key=>$row)
                {
                   if($row['luggage']=="")
                    $luggage=0;
                    else
                    $luggage=$row['luggage'];

                    $rideid=$row['ride_id'];
                    echo "<tr>";
                    echo "<td>".$row['ride_date']."</td>";
                    echo "<td>".$row['from_distance']."</td>";
                    echo "<td>".$row['to_distance']."</td>";
                    echo "<td>".$row['total_distance']."</td>";
                    echo "<td>".$luggage."</td>";  
                    echo "<td>".$row['total_fare']."</td>"; 
                    echo "<td>".$row['car']."</td>";

                   

                    
                   
                }
                  ?> 
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
                        url: 'filteruser.php',
                        data:{
                           id15:id,
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
        url: 'filteruser.php',
        data:{
        id13:id,
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
        url: 'filteruser.php',
        data:{
        id34:id,
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