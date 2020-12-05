<?php 

include 'user.php';
include 'header1.php';


if(isset($_SESSION['userdata']['username']))
{
    if($_SESSION['userdata']['name']!="admin")

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
        <title>User</title>
    </head>
    <link rel="stylesheet" type="text/css" href="styleadmin.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <body>
        <div class="main">
            <div id="asider">
                <h3 style="color:white">Hello <?php echo $_SESSION["userdata"]["name"] ?></h3>

                <ul>
                    <li class="li"><a href="bookride.php">Dashboard</li>
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
                  
                   
                    

                </ul>

            </div>
            <div class="container"> 
               

                <div class="section">
                
                <?php
         
                ?>
                        <h2 style="text-align:center">Pending Rides:</h2><br>
                    
                    <label style="margin-top:10px;">Sort by: 
                    <select id="select">
                        <option value="none">None</option>
                        <option value="total_fare">Fare</option>
                        <option value="total_distance">Distance</option>
                        <option value="ride_date">Date</option>
                    </select></label>


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
                    <th>Action</th>
                    <th>View</th>
                  
                    </tr>
                    <tbody>


                <?php
                $user=new user();
                $dbconnect=new Dbconnect();
                $row1=$user->pendingride($id,$dbconnect->conn);

                if(isset($row1))
                {
               
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
                    echo "<td><a href='user.php?id5=".$id."&rideid=".$rideid."'>Cancel Ride</a></td>";
                    echo "<td><a href='invoiceuser.php?id54=".$row['customer_user_id']."&rid=".$row['ride_id']."'>Invoice</a></td>";
                
                }
            }
                  ?> 
                  </tbody>
            </table>
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
                           id12:id,
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
        id54:id,
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
        id32:id,
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
{
    echo 'Please Login,first to continue <a href="login2.php">Click here to login</a>';
}
?>