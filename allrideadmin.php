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
                    <li class="li"><a href="viewnewuser.php">View New/Delete User
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

                    <h2 style="text-align:center">All Rides:</h2><br>
              
                
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

                    <th>View</th>
                  

                    
                   
                  
                    </tr>
                    <tbody>


                <?php
                $admin=new adminwork();
                $dbconnect=new Dbconnect();
                $row1=$admin->adminallride($dbconnect->conn);

                  
             

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
                    echo "<td><a href='invoice.php?id54=".$row['customer_user_id']."&rid=".$row['ride_id']."'>Invoice</a></td>";
                     

                   
     
       
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
                        url: 'filteradmin.php',
                        data:{
                           id56:id,
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
        id59:id,
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
        id60:id,
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
  window.location= "Logout.php";
  </script>';
  }
}

else
{
    echo 'Please Login,first to continue <a href="login2.php">Click here to login</a>';
}

?>