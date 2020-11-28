<?php
session_start();
require 'Dbconnect.php';

 if(isset($_GET['id5']))
 {
     $id=$_GET['id5'];
     $rideid=$_GET['rideid'];
     $user=new user();
     $dbcon=new Dbconnect(); 
     $user->canceluserride($id,$rideid,$dbcon->conn);
 }

 
 if(isset($_POST['update2']))
 {
     $id=$_GET['id6'];
     $name=$_POST['name'];
     $mobile=$_POST['mobile'];
     $user=new user();
     $dbcon=new Dbconnect(); 
     $user->updateuser2($id,$name,$mobile,$dbcon->conn);
 }

 if(isset($_POST['update3']))
 {
     $id=$_GET['id7'];
     $name=$_POST['oldpass'];
     $newpass=$_POST['newpass'];
     $conpass=$_POST['conpass'];
     $user=new user();
     $dbcon=new Dbconnect(); 
     $user->updatepass($id,$name,$newpass,$conpass,$dbcon->conn);
 }


class user
{
    
    public $username;
    public $password;
    public $confirmpassword;
    public $userid;
    public $name;
    public $date;
    public $mobile;
    public $isblock;
    public $isadmin;
    


    function Login($username,$password,$conn)
    {
        $error=array();
      
      
        
         
    if ($username=="" || $password=="") {
        $error[]=array("id"=>'form','msg'=>"Field cant be empty");
    }

    if (count($error)==0) {
        $sql = "SELECT * FROM `tbl_user` WHERE `user_name`='".$username."'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {

                //echo "<br>".$row['password'];
               
                if ($row['user_name']==$username && $row['password']==$password && $row['isblock']==1) {
                    if ($row['is_admin']==0) {
                        $_SESSION['userdata']=array('userid'=>$row['user_id'],
                        'username'=>$row['user_name'],'name'=>$row['name']);  
                        header('Location:admin.php'); 
                    } else if($row['is_admin']==1){

                        $_SESSION['userdata']=array('userid'=>$row['user_id'],
                        'username'=>$row['user_name'],'name'=>$row['name']);  
                        header('Location:homeuser.php');
                    }
                } else {
                        echo "<p style='color:red;margin:10px 0px 0px 30%;'>Username or Password does'nt match</p>";
                }
            }
        } 

    } else {
        foreach ($error as $err) {
            $display=$err['msg'];
        }
        }

    }




function register($username,$password,$name,$confirmpassword,$mobile,$date,$conn)
{

  
    $error=array();


    if ($username=="" || $password=="" || $confirmpassword=="" || $name=="" ||$mobile=="") {
        $error[]=array("id"=>'form','msg'=>"Field cant be empty");
    }

    if ($password!=$confirmpassword) {
        $error[]=array("id"=>'form','msg'=>"Password does not matches ");
    }


    $sql1 = "SELECT * FROM tbl_user WHERE user_name='".$username."'";
    $result = $conn->query($sql1);

    if ($result->num_rows > 0) {
        $error[]=array("id"=>'form','msg'=>"Username/Email already present");

    } 

    

    if (count($error)==0) {
        //$password=md5($password);

            $sql = "INSERT INTO tbl_user (user_name, name, dateofsignup, mobile, isblock, password, is_admin)
            VALUES ('".$username."','".$name."','".$date."','".$mobile."',0,'".$password."',1)";
        if ($conn->query($sql) === true) {
            echo '<p style="color:green;margin-left:30%;font-size:20px;
            margin-top:10px">Registration done successfully,Please wait few mins so that admin can grand permission<p>';
        } else {
            echo 'unsuccesful';
        }
    } else {
        foreach ($error as $err) {
            $display=$err['msg'];
        }
    }




}


function book($pick,$drop,$cars,$weight,$date,$conn)
{
    echo $cars;
    if($drop==$pick ||  $pick=="0" || $drop=="10" || $cars=="20")
    {
        echo 'Location cant be Same or Field is empty';
    }
    else
    {
    if(isset($_SESSION['userdata']))
    {
    $id=$_SESSION['userdata']['userid'];
    if(isset($_SESSION['book']))
    {
    $drop2=$_SESSION['book']['to'];
    $pick2=$_SESSION['book']['from'];
    $cars2=$_SESSION['book']['cars'];
    $weight2=$_SESSION['book']['weight'];

  
    
    
    
   
    $distance1=0;
    $distance2=0;
    $totalcost=0;
    date_default_timezone_set("Asia/Calcutta");

        $sql = "SELECT distance FROM tbl_location WHERE `name`='".$pick2."'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
        
        while($row = $result->fetch_assoc()) {
            $distance1=$row['distance'];
        }
        } 


        $sql1 = "SELECT distance FROM tbl_location WHERE `name`='".$drop2."'";
        $result1 = $conn->query($sql1);

        if ($result1->num_rows > 0) {
        
        while($row1 = $result1->fetch_assoc()) {
            $distance2=$row1['distance'];
        }
        } 

$totaldistance=abs($distance2-$distance1);



if($cars=="cedmicro")
{
    if($totaldistance<=10)
    {
        $totalcost=50+($totaldistance*13.50);
    }
    elseif($totaldistance>=10 && $totaldistance<=60)
    {
        $totalcost=50+(10*13.50)+(($totaldistance-10)*12);
    }

    elseif($totaldistance>=60 && $totaldistance<=160)
    {
        $totalcost=50+(10*13.50)+(50*12)+(($totaldistance-60)*10.20);
    }

    elseif($totaldistance>=160)
    {
        $totalcost=50+(10*13.50)+(50*12)+(100*10.20)+(($totaldistance-160)*8.50);
    }
}

elseif($cars=="cedmini")
{

    if($totaldistance<=10)
    {
        $totalcost+=150+($totaldistance*14.50);
    }
    elseif($totaldistance>10 && $totaldistance<=60)
    {
        $totalcost+=150+(10*14.50)+(($totaldistance-10)*13);
    }

    elseif($totaldistance>60 && $totaldistance<=160)
    {
        $totalcost+=150+(10*14.50)+(50*13)+(($totaldistance-60)*11.20);
    }

    elseif($totaldistance>160)
    {
        $totalcost+=150+(10*14.50)+(50*13)+(100*11.20)+(($totaldistance-160)*9.50);
    }

    if($weight>=1 && $weight<=10)
    {
        $totalcost=$totalcost+50;
    }

    if($weight>10 && $weight<=20)
    {
        $totalcost=$totalcost+100;
    }
    if($weight>20)
    {
        $totalcost=$totalcost+200;
    }

}


elseif($cars=="cedroyal")
{

    if($totaldistance<=10)
    {
        $totalcost+=200+($totaldistance*15.50);
    }
    elseif($totaldistance>10 && $totaldistance<=60)
    {
        $totalcost+=200+(10*15.50)+(($totaldistance-10)*14);
    }

    elseif($totaldistance>60 && $totaldistance<=160)
    {
        $totalcost+=200+(10*15.50)+(50*14)+(($totaldistance-60)*12.20);
    }

    elseif($totaldistance>160)
    {
        $totalcost+=200+(10*15.50)+(50*14)+(100*12.20)+(($totaldistance-160)*10.50);
    }

    if($weight>=1 && $weight<=10)
    {
        $totalcost=$totalcost+50;
    }

    if($weight>10 && $weight<=20)
    {
        $totalcost=$totalcost+100;
    }
    if($weight>20)
    {
        $totalcost=$totalcost+200;
    }

}


elseif($cars=="cedsuv")
{

    if($totaldistance<=10)
    {
        $totalcost+=250+($totaldistance*16.50);
    }
    elseif($totaldistance>10 && $totaldistance<=60)
    {
        $totalcost+=250+(10*16.50)+(($totaldistance-10)*15);
    }

    elseif($totaldistance>60 && $totaldistance<=160)
    {
        $totalcost+=250+(10*16.50)+(50*15)+(($totaldistance-60)*13.20);
    }

    elseif($totaldistance>160)
    {
        $totalcost+=250+(10*16.50)+(50*15)+(100*13.20)+(($totaldistance-160)*11.50);
    }

    if($weight>=1 && $weight<=10)
    {
        $totalcost=$totalcost+100;
    }

    if($weight>10 && $weight<=20)
    {
        $totalcost=$totalcost+200;
    }
    if($weight>20)
    {
        $totalcost=$totalcost+400;
    }

}

    $sql5 = "INSERT INTO `tbl_ride`(`ride_date`, `from_distance`, `to_distance`, `total_distance`, `luggage`, `total_fare`, `status`, `customer_user_id`,`car`)
    VALUES ('".$date."', '".$pick2."', '".$drop2."', '".$totaldistance."', '".$weight2."', '".$totalcost."', 1,'".$id."','".$cars2."')";

    if ($conn->query($sql5) === TRUE) {
    
  } 

    
echo " YOur Ride has been booked please wait for corfirmation. Total fare is ".$totalcost;


}

    
    else
    {
        $distance1=0;
        $distance2=0;
        $totalcost=0;
        $sql = "SELECT distance FROM tbl_location WHERE `name`='".$pick."'";
        $result = $conn->query($sql);
    
        if ($result->num_rows > 0) {
        
        while($row = $result->fetch_assoc()) {
            $distance1=$row['distance'];
        }
        } 
    
    
        $sql1 = "SELECT distance FROM tbl_location WHERE `name`='".$drop."'";
        $result1 = $conn->query($sql1);
    
        if ($result1->num_rows > 0) {
        
        while($row1 = $result1->fetch_assoc()) {
            $distance2=$row1['distance'];
        }
        } 
    
    $totaldistance=abs($distance2-$distance1);
    
    
    
    if($cars=="cedmicro")
    {
    if($totaldistance<=10)
    {
        $totalcost=50+($totaldistance*13.50);
    }
    elseif($totaldistance>=10 && $totaldistance<=60)
    {
        $totalcost=50+(10*13.50)+(($totaldistance-10)*12);
    }
    
    elseif($totaldistance>=60 && $totaldistance<=160)
    {
        $totalcost=50+(10*13.50)+(50*12)+(($totaldistance-60)*10.20);
    }
    
    elseif($totaldistance>=160)
    {
        $totalcost=50+(10*13.50)+(50*12)+(100*10.20)+(($totaldistance-160)*8.50);
    }
    }
    
    elseif($cars=="cedmini")
    {
    
    if($totaldistance<=10)
    {
        $totalcost+=150+($totaldistance*14.50);
    }
    elseif($totaldistance>10 && $totaldistance<=60)
    {
        $totalcost+=150+(10*14.50)+(($totaldistance-10)*13);
    }
    
    elseif($totaldistance>60 && $totaldistance<=160)
    {
        $totalcost+=150+(10*14.50)+(50*13)+(($totaldistance-60)*11.20);
    }
    
    elseif($totaldistance>160)
    {
        $totalcost+=150+(10*14.50)+(50*13)+(100*11.20)+(($totaldistance-160)*9.50);
    }
    
    if($weight>=1 && $weight<=10)
    {
        $totalcost=$totalcost+50;
    }
    
    if($weight>10 && $weight<=20)
    {
        $totalcost=$totalcost+100;
    }
    if($weight>20)
    {
        $totalcost=$totalcost+200;
    }
    
    }
    
    
    elseif($cars=="cedroyal")
    {
    
    if($totaldistance<=10)
    {
        $totalcost+=200+($totaldistance*15.50);
    }
    elseif($totaldistance>10 && $totaldistance<=60)
    {
        $totalcost+=200+(10*15.50)+(($totaldistance-10)*14);
    }
    
    elseif($totaldistance>60 && $totaldistance<=160)
    {
        $totalcost+=200+(10*15.50)+(50*14)+(($totaldistance-60)*12.20);
    }
    
    elseif($totaldistance>160)
    {
        $totalcost+=200+(10*15.50)+(50*14)+(100*12.20)+(($totaldistance-160)*10.50);
    }
    
    if($weight>=1 && $weight<=10)
    {
        $totalcost=$totalcost+50;
    }
    
    if($weight>10 && $weight<=20)
    {
        $totalcost=$totalcost+100;
    }
    if($weight>20)
    {
        $totalcost=$totalcost+200;
    }
    
    }
    
    
    elseif($cars=="cedsuv")
    {
    
    if($totaldistance<=10)
    {
        $totalcost+=250+($totaldistance*16.50);
    }
    elseif($totaldistance>10 && $totaldistance<=60)
    {
        $totalcost+=250+(10*16.50)+(($totaldistance-10)*15);
    }
    
    elseif($totaldistance>60 && $totaldistance<=160)
    {
        $totalcost+=250+(10*16.50)+(50*15)+(($totaldistance-60)*13.20);
    }
    
    elseif($totaldistance>160)
    {
        $totalcost+=250+(10*16.50)+(50*15)+(100*13.20)+(($totaldistance-160)*11.50);
    }
    
    if($weight>=1 && $weight<=10)
    {
        $totalcost=$totalcost+100;
    }
    
    if($weight>10 && $weight<=20)
    {
        $totalcost=$totalcost+200;
    }
    if($weight>20)
    {
        $totalcost=$totalcost+400;
    }
    
    
    }
    echo"Total cost: ".($totalcost);
        
}
    }

else
{
    $drop2=$_SESSION['book']['to'];
    $pick2=$_SESSION['book']['from'];
    $cars2=$_SESSION['book']['cars'];
    $weight2=$_SESSION['book']['weight'];
    $distance1=0;
    $distance2=0;
    $totalcost=0;
    $sql = "SELECT distance FROM tbl_location WHERE `name`='".$pick2."'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
    
    while($row = $result->fetch_assoc()) {
        $distance1=$row['distance'];
    }
    } 


    $sql1 = "SELECT distance FROM tbl_location WHERE `name`='".$drop2."'";
    $result1 = $conn->query($sql1);

    if ($result1->num_rows > 0) {
    
    while($row1 = $result1->fetch_assoc()) {
        $distance2=$row1['distance'];
    }
    } 

$totaldistance=abs($distance2-$distance1);



if($cars=="cedmicro")
{
if($totaldistance<=10)
{
    $totalcost=50+($totaldistance*13.50);
}
elseif($totaldistance>=10 && $totaldistance<=60)
{
    $totalcost=50+(10*13.50)+(($totaldistance-10)*12);
}

elseif($totaldistance>=60 && $totaldistance<=160)
{
    $totalcost=50+(10*13.50)+(50*12)+(($totaldistance-60)*10.20);
}

elseif($totaldistance>=160)
{
    $totalcost=50+(10*13.50)+(50*12)+(100*10.20)+(($totaldistance-160)*8.50);
}
}

elseif($cars=="cedmini")
{

if($totaldistance<=10)
{
    $totalcost+=150+($totaldistance*14.50);
}
elseif($totaldistance>10 && $totaldistance<=60)
{
    $totalcost+=150+(10*14.50)+(($totaldistance-10)*13);
}

elseif($totaldistance>60 && $totaldistance<=160)
{
    $totalcost+=150+(10*14.50)+(50*13)+(($totaldistance-60)*11.20);
}

elseif($totaldistance>160)
{
    $totalcost+=150+(10*14.50)+(50*13)+(100*11.20)+(($totaldistance-160)*9.50);
}

if($weight>=1 && $weight<=10)
{
    $totalcost=$totalcost+50;
}

if($weight>10 && $weight<=20)
{
    $totalcost=$totalcost+100;
}
if($weight>20)
{
    $totalcost=$totalcost+200;
}

}


elseif($cars=="cedroyal")
{

if($totaldistance<=10)
{
    $totalcost+=200+($totaldistance*15.50);
}
elseif($totaldistance>10 && $totaldistance<=60)
{
    $totalcost+=200+(10*15.50)+(($totaldistance-10)*14);
}

elseif($totaldistance>60 && $totaldistance<=160)
{
    $totalcost+=200+(10*15.50)+(50*14)+(($totaldistance-60)*12.20);
}

elseif($totaldistance>160)
{
    $totalcost+=200+(10*15.50)+(50*14)+(100*12.20)+(($totaldistance-160)*10.50);
}

if($weight>=1 && $weight<=10)
{
    $totalcost=$totalcost+50;
}

if($weight>10 && $weight<=20)
{
    $totalcost=$totalcost+100;
}
if($weight>20)
{
    $totalcost=$totalcost+200;
}

}


elseif($cars=="cedsuv")
{

if($totaldistance<=10)
{
    $totalcost+=250+($totaldistance*16.50);
}
elseif($totaldistance>10 && $totaldistance<=60)
{
    $totalcost+=250+(10*16.50)+(($totaldistance-10)*15);
}

elseif($totaldistance>60 && $totaldistance<=160)
{
    $totalcost+=250+(10*16.50)+(50*15)+(($totaldistance-60)*13.20);
}

elseif($totaldistance>160)
{
    $totalcost+=250+(10*16.50)+(50*15)+(100*13.20)+(($totaldistance-160)*11.50);
}

if($weight>=1 && $weight<=10)
{
    $totalcost=$totalcost+100;
}

if($weight>10 && $weight<=20)
{
    $totalcost=$totalcost+200;
}
if($weight>20)
{
    $totalcost=$totalcost+400;
}


}
echo"Total cost: ".($totalcost);
    
}  
}

}

function pendingride($id,$conn)
{


    $sql = "SELECT * FROM tbl_ride WHERE `status`=1 AND `customer_user_id`='".$id."'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
   $row2=array();
    while($row = $result->fetch_assoc()) {
       
        array_push($row2,$row);


    }
    return $row2;
    } else {
    echo "0 results";
    }


}


function canceluserride($id,$rideid,$conn)
{
    $sql = "UPDATE tbl_ride SET status=0  WHERE customer_user_id=".$id." AND `status`=1 AND `ride_id`=".$rideid."";

    if ($conn->query($sql) === TRUE) {
    echo '<script type="text/javascript">; 
    alert("Ride Cancel successfully"); 
    window.location= "pendingride.php";
    </script>';   
    } else {
    echo "Error updating record: " . $conn->error;
    }
}


function cancelledride($id,$conn)
{

    $sql = "SELECT * FROM tbl_ride WHERE (`status`=0 OR `status`=3) AND `customer_user_id`='".$id."'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
   $row2=array();
    while($row = $result->fetch_assoc()) {
       
        array_push($row2,$row);


    }
    return $row2;
    } else {
    echo "0 results";
    }
}

function completedride($id,$conn)
{

    $sql = "SELECT * FROM tbl_ride WHERE `status`=2 AND `customer_user_id`='".$id."'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
   $row2=array();
    while($row = $result->fetch_assoc()) {
       
        array_push($row2,$row);


    }
    return $row2;
    } else {
    echo "0 results";
    }
}

function allride($id,$conn)
{

    $sql = "SELECT * FROM tbl_ride WHERE `customer_user_id`='".$id."'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
   $row2=array();
    while($row = $result->fetch_assoc()) {
       
        array_push($row2,$row);


    }
    return $row2;
    } else {
    echo "0 results";
    }
}

function updateuser($id,$conn)
{

    $sql = "SELECT * FROM tbl_user WHERE user_id=".$id."";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
     $row2=array();
      while($row = $result->fetch_assoc()) {
        array_push($row2,$row);
      }
      return $row2;
    } else {
      echo "0 results";
    }

}

function updateuser2($id,$name,$mobile,$conn)
{
   
    $sql = "UPDATE tbl_user SET name='".$name."' , mobile='".$mobile."' WHERE user_id=".$id."";

    if ($conn->query($sql) === TRUE) {
        echo '<script type="text/javascript">; 
        alert("Update Done successfully"); 
        window.location= "updateuser.php";
        </script>';   
    } else {
      echo "Error updating record: " . $conn->error;
    }
    

}

function updatepass($id,$name,$newpass,$conpass,$conn)
{
   $count=0;
   $pass=md5($name);
   $newpass=md5($newpass);
   $conpass=md5($conpass);
    $sql = "SELECT `password` FROM `tbl_user` WHERE `user_id`=".$id."";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
   
    while($row = $result->fetch_assoc()) {

       $dbpass=$row['password'];



        
    }
    if($pass==$dbpass)
    {
    $count=1;
    }
    else
    {
    $count=0;
   
    }
    } 


    if($count==1 && $newpass==$conpass)

    {
    
        $sql2 = "UPDATE tbl_user SET password='".$newpass."' WHERE user_id=".$id."";

        if ($conn->query($sql2) === TRUE) {
            echo '<script type="text/javascript">; 
            alert("Password Changed successfully ,Please relogin agn with new pass"); 
            window.location= "Logout.php";
            </script>';   
        }

    }
    else
    {
        echo '<script type="text/javascript">; 
            alert("Password does not matched "); 
            window.location= "changepass.php";
           
            </script>';   
    }
    

}

function filteruser($id12,$text,$conn)
{

    $row1=array();
    if($text!="none")
    {

    $sql = "SELECT * FROM tbl_ride WHERE customer_user_id=".$id12." AND status=1 ORDER BY ".$text." ASC";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
   
      while($row = $result->fetch_assoc()) {

        array_push($row1,$row);
      
      }
      return $row1;
    } else {
      echo "0 results";
    }
}
else
{
    $sql = "SELECT * FROM tbl_ride WHERE customer_user_id=".$id12." AND status=1";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
   
      while($row = $result->fetch_assoc()) {

        array_push($row1,$row);
      
      }
      return $row1;
    } else {
      echo "0 results";
    }
}



}


function filtercompleteuser($id13,$text,$conn)
{

    $row1=array();
    if($text!="none")
    {

    $sql = "SELECT * FROM tbl_ride WHERE customer_user_id=".$id13." AND status=2 ORDER BY ".$text." ASC";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
   
      while($row = $result->fetch_assoc()) {

        array_push($row1,$row);
      
      }
      return $row1;
    } else {
      echo "0 results";
    }
}
else
{
    $sql = "SELECT * FROM tbl_ride WHERE customer_user_id=".$id13." AND status=2";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
   
      while($row = $result->fetch_assoc()) {

        array_push($row1,$row);
      
      }
      return $row1;
    } else {
      echo "0 results";
    }
}



}


function filtercanceluser($id14,$text,$conn)
{

    $row1=array();
    if($text!="none")
    {

    $sql = "SELECT * FROM tbl_ride WHERE customer_user_id=".$id14." AND status=0 OR status=3 ORDER BY ".$text." ASC";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
   
      while($row = $result->fetch_assoc()) {

        array_push($row1,$row);
      
      }
      return $row1;
    } else {
      echo "0 results";
    }
}
else
{
    $sql = "SELECT * FROM tbl_ride WHERE customer_user_id=".$id14." AND status=2 OR status=3";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
   
      while($row = $result->fetch_assoc()) {

        array_push($row1,$row);
      
      }
      return $row1;
    } else {
      echo "0 results";
    }
}



}


function filteralluser($id15,$text,$conn)
{

    $row1=array();
    if($text!="none")
    {

    $sql = "SELECT * FROM tbl_ride WHERE customer_user_id=".$id15." ORDER BY ".$text." ASC";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
   
      while($row = $result->fetch_assoc()) {

        array_push($row1,$row);
      
      }
      return $row1;
    } else {
      echo "0 results";
    }
}
else
{
    $sql = "SELECT * FROM tbl_ride WHERE customer_user_id=".$id15."";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
   
      while($row = $result->fetch_assoc()) {

        array_push($row1,$row);
      
      }
      return $row1;
    } else {
      echo "0 results";
    }
}



}

function home($conn)
{


    $row1=array();
    $sql = "SELECT * FROM tbl_location WHERE is_available=1";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
   
      while($row = $result->fetch_assoc()) {

        array_push($row1,$row);
      
      }
      return $row1;
    } else {
      echo "0 results";
    }

}

function filteruserride($id20,$value,$conn)


{

    if($value=="week")
  {
    $sql="SELECT * FROM tbl_ride WHERE ride_date > DATE_SUB(NOW(), INTERVAL 1 WEEK)  AND customer_user_id='".$id20."'";
    $result = $conn->query($sql);
  
    $row1=array();
      
    if ($result->num_rows > 0) {
   
      while($row = $result->fetch_assoc()) {
  
        array_push($row1,$row);
      
      }
      return $row1;
    } else {
      echo "0 results";
    }
  }
  else if($value=="month")
  {
  
    $sql="SELECT * FROM tbl_ride WHERE ride_date > DATE_SUB(NOW(), INTERVAL 1 MONTH)  AND customer_user_id='".$id20."'";
    $result = $conn->query($sql);
    $row1=array();
      
    if ($result->num_rows > 0) {
   
      while($row = $result->fetch_assoc()) {
  
        array_push($row1,$row);
      
      }
      return $row1;
    } else {
      echo "0 results";
    }
  
  }
  
  else if($value=="today")
  {
  
    $sql="SELECT * FROM tbl_ride WHERE ride_date > DATE_SUB(NOW(), INTERVAL 1 DAY)  AND customer_user_id=".$id20."";
    $result = $conn->query($sql);
    $row1=array();
      
    if ($result->num_rows > 0) {
   
      while($row = $result->fetch_assoc()) {
  
        array_push($row1,$row);
      
      }
      return $row1;
    } else {
      echo "0 results";
    }
  
  
   }
  




}


function filteruserpendingride($id21,$value,$conn)
{


    if($value=="week")
    {
      $sql="SELECT * FROM tbl_ride WHERE ride_date > DATE_SUB(NOW(), INTERVAL 1 WEEK) AND status=1  AND customer_user_id='".$id21."'";
      $result = $conn->query($sql);
    
      $row1=array();
        
      if ($result->num_rows > 0) {
     
        while($row = $result->fetch_assoc()) {
    
          array_push($row1,$row);
        
        }
        return $row1;
      } else {
        echo "0 results";
      }
    }
    else if($value=="month")
    {
    
      $sql="SELECT * FROM tbl_ride WHERE ride_date > DATE_SUB(NOW(), INTERVAL 1 MONTH) AND status=1  AND customer_user_id='".$id21."'";
      $result = $conn->query($sql);
      $row1=array();
        
      if ($result->num_rows > 0) {
     
        while($row = $result->fetch_assoc()) {
    
          array_push($row1,$row);
        
        }
        return $row1;
      } else {
        echo "0 results";
      }
    
    }
    
    else if($value=="today")
    {
    
      $sql="SELECT * FROM tbl_ride WHERE ride_date > DATE_SUB(NOW(), INTERVAL 1 DAY) AND status=1  AND customer_user_id=".$id21."";
      $result = $conn->query($sql);
      $row1=array();
        
      if ($result->num_rows > 0) {
     
        while($row = $result->fetch_assoc()) {
    
          array_push($row1,$row);
        
        }
        return $row1;
      } else {
        echo "0 results";
      }
    
    
     }
    



}



function filterusercompletedride($id20,$value,$conn)
{


    if($value=="week")
    {
      $sql="SELECT * FROM tbl_ride WHERE ride_date > DATE_SUB(NOW(), INTERVAL 1 WEEK) AND status=2  AND customer_user_id='".$id20."'";
      $result = $conn->query($sql);
    
      $row1=array();
        
      if ($result->num_rows > 0) {
     
        while($row = $result->fetch_assoc()) {
    
          array_push($row1,$row);
        
        }
        return $row1;
      } else {
        echo "0 results";
      }
    }
    else if($value=="month")
    {
    
      $sql="SELECT * FROM tbl_ride WHERE ride_date > DATE_SUB(NOW(), INTERVAL 1 MONTH) AND status=2  AND customer_user_id='".$id20."'";
      $result = $conn->query($sql);
      $row1=array();
        
      if ($result->num_rows > 0) {
     
        while($row = $result->fetch_assoc()) {
    
          array_push($row1,$row);
        
        }
        return $row1;
      } else {
        echo "0 results";
      }
    
    }
    
    else if($value=="today")
    {
    
      $sql="SELECT * FROM tbl_ride WHERE ride_date > DATE_SUB(NOW(), INTERVAL 1 DAY) AND status=2  AND customer_user_id=".$id20."";
      $result = $conn->query($sql);
      $row1=array();
        
      if ($result->num_rows > 0) {
     
        while($row = $result->fetch_assoc()) {
    
          array_push($row1,$row);
        
        }
        return $row1;
      } else {
        echo "0 results";
      }
    
    
     }
    



}




function filterusercancelride($id20,$value,$conn)
{


    if($value=="week")
    {
      $sql="SELECT * FROM tbl_ride WHERE ride_date > DATE_SUB(NOW(), INTERVAL 1 WEEK) AND (status=0 OR status=3)  AND customer_user_id='".$id20."'";
      $result = $conn->query($sql);
    
      $row1=array();
        
      if ($result->num_rows > 0) {
     
        while($row = $result->fetch_assoc()) {
    
          array_push($row1,$row);
        
        }
        return $row1;
      } else {
        echo "0 results";
      }
    }
    else if($value=="month")
    {
    
      $sql="SELECT * FROM tbl_ride WHERE ride_date > DATE_SUB(NOW(), INTERVAL 1 MONTH) AND (status=0 OR status=3) AND customer_user_id='".$id20."'";
      $result = $conn->query($sql);
      $row1=array();
        
      if ($result->num_rows > 0) {
     
        while($row = $result->fetch_assoc()) {
    
          array_push($row1,$row);
        
        }
        return $row1;
      } else {
        echo "0 results";
      }
    
    }
    
    else if($value=="today")
    {
    
      $sql="SELECT * FROM tbl_ride WHERE ride_date > DATE_SUB(NOW(), INTERVAL 1 DAY) AND (status=0 OR status=3) AND customer_user_id=".$id20."";
      $result = $conn->query($sql);
      $row1=array();
        
      if ($result->num_rows > 0) {
     
        while($row = $result->fetch_assoc()) {
    
          array_push($row1,$row);
        
        }
        return $row1;
      } else {
        echo "0 results";
      }
    
    
     }
    



}





}




?>