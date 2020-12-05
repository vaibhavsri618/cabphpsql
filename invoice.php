<?php



include 'header.php';


include 'adminwork.php';



if(isset($_SESSION['userdata']['name']))
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
	<link rel="stylesheet" type="text/css" href="cab.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
    <body style="background:none">
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
               
				


				if(isset($_GET['id54']) && isset($_GET['rid']))

					{
						$rid="";
						$rdate="";
						$from="";
						$to="";
						$distance="";
						$luggage="";
						$fare="";
						$status="";
						$car="";
						$name="";
						$userid="";

					$id54=$_GET['id54'];
					$ride_id=$_GET['rid'];


					$admin=new adminwork();
					$dbcon=new Dbconnect();
					$row1=$admin->getname($id54,$dbcon->conn);

					foreach($row1 as $key=>$val)
					{
						$userid=$val['user_name'];
						$name=$val['name'];
					}


					// $admin=new adminwork();
					// $dbcon=new Dbconnect();
					$row=$admin->viewinvoice($id54,$ride_id,$dbcon->conn);
					foreach($row as $key=>$row1)

					{
						$rid=$row1['ride_id'];
						$rdate=$row1['ride_date'];
						$from=$row1['from_distance'];
						$to=$row1['to_distance'];
						$distance=$row1['total_distance'];
						$luggage=$row1['luggage'];
						$fare=$row1['total_fare'];

						if($row1['status']==0 || $row1['status']==3)
						$status="cancel";
						else if($row1['status']==2)
						$status="completed";
						else if($row1['status']==1)
						$status="pending";




					}


					}

					
                ?>
				<div id="invoice">
				<input type="button" class="btn btn-primary btn-sm" value="CedCab" id="button1" style="margin-left:10px"><br><br>
				<label>InVoice</label><br>
				<label class="label1">Ride id</label> : 
				<label><?php echo $rid; ?> </label><br>

				<label class="label1">User id</label> : 
				<label><?php echo $userid; ?> </label><br>

				<label class="label1">User Name</label> : 
				<label><?php echo $name; ?> </label><br>

				<label class="label1">Ride Date</label> : 
				<label><?php echo $rdate; ?> </label><br>

				<label class="label1">From Distance</label> : 
				<label><?php echo $from; ?> </label><br>


				<label class="label1">To Distance</label> : 
				<label><?php echo $to; ?> </label><br>

				<label class="label1">Total Distance</label> : 
				<label><?php echo $distance; ?> </label><br>

				<label class="label1">Luggage</label> : 
				<label><?php echo $luggage; ?> </label><br>

				<label class="label1">Fare</label> : 
				<label><?php echo $fare; ?> </label><br>

				<label class="label1">Status</label> : 
				<label><?php echo $status; ?> </label><br><br>


				<button onclick="window.print()">Print Recipt</button>



				
				
			

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
            echo 'Please Login,first to continue <a href="login2.php">Click here to login</a>';
?>




