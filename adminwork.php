<?php


require 'Dbconnect.php';

if(isset($_GET['id3']))

{
    $id3=$_GET['id3'];
    $admin=new adminwork();
    $dbcon=new Dbconnect();
    $admin->cancelridereq($id3,$dbcon->conn);
}


if (isset($_POST['update2'])) {
  $id = $_GET['id6'];
  $name = $_POST['name'];
  $mobile = $_POST['mobile'];
  $user = new adminwork();
  $dbcon = new Dbconnect();
  $user->updateadmin2($id, $name, $mobile, $dbcon->conn);
}

if (isset($_POST['update3'])) {
  $id = $_GET['id7'];
  $name = $_POST['oldpass'];
  $newpass = $_POST['newpass'];
  $conpass = $_POST['conpass'];
  $user = new adminwork();
  $dbcon = new Dbconnect();
  $user->updateadminpass($id, $name, $newpass, $conpass, $dbcon->conn);
}


if(isset($_GET['id50']))

{
    $id50=$_GET['id50'];
    $admin=new adminwork();
    $dbcon=new Dbconnect();
    $admin->blockuser($id50,$dbcon->conn);
}


if(isset($_GET['id52']))

{
    $id52=$_GET['id52'];
    $admin=new adminwork();
    $dbcon=new Dbconnect();
    $admin->deleteuser($id52,$dbcon->conn);
}


class adminwork{

function newuser($conn)
{
    $row1=array();
    $sql = "SELECT * FROM tbl_user WHERE isblock=0";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
   
   
    while($row = $result->fetch_assoc()) {

        array_push($row1,$row);
       



    }

    return $row1;
}
     else {
    echo "No New User found";
    }

    

}

function adminallride($conn)
{
    $row2 = array();
    $sql =
        "SELECT * FROM tbl_ride";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
       
        while ($row = $result->fetch_assoc()) {
            array_push($row2, $row);
        }
        return $row2;
    } else {
        echo "0 results";
    }
}

function addlocation($drop,$distance,$radio,$conn)
{

    $error=array();


    if ($drop=="" || $distance=="") {
        $error[]=array("id"=>'form','msg'=>"Field cant be empty");
    }

   

    $sql1 = "SELECT * FROM tbl_location WHERE name='".$drop."'";
    $result = $conn->query($sql1);

    if ($result->num_rows > 0) {
        $error[]=array("id"=>'form','msg'=>"Location already present");

    } 

    

    if (count($error)==0) {
        

            $sql2 = "INSERT INTO `tbl_location` (`name`, `distance`, `is_available`)
            VALUES ('".$drop."','".$distance."','".$radio."')";
        if ($conn->query($sql2) === true) {
            echo '<p style="color:green;margin-left:30%;font-size:20px;
            margin-top:10px">Distance Added Successfully<p>';
        } else {
            echo 'unsuccesful';
        }
    } else {
        foreach ($error as $err) {
            $display=$err['msg'];
        }
    }




}


function newride($conn)
{
    $sql7 = "SELECT * FROM `tbl_ride` WHERE `status`=1";
    $result7 = $conn->query($sql7);

    $row1=array();

    if ($result7->num_rows > 0) {
   
    while($row7 = $result7->fetch_assoc()) {

        array_push($row1,$row7);
        
     



    }
    return $row1;
}
     else {
    echo "No New User found";
    }

    

}

function totalearning($conn)
{
    
    $sql8 = "SELECT total_fare FROM `tbl_ride` WHERE `status`=2";
    $result8 = $conn->query($sql8);

    if ($result8->num_rows > 0) {
        $total=0;
   
    while($row8 = $result8->fetch_assoc()) {
        
     
        $cost=$row8['total_fare'];
       
 
       $total=$total+($cost);
      
        

    
      
      
       
       
     



    }
    echo $total;
    
   

      
}
   
    

  
}


function viewlocation($conn)
{
    $sql8 = "SELECT * FROM `tbl_location` order by distance";
    $result8 = $conn->query($sql8);
    $row1=array();

    if ($result8->num_rows > 0) {
  

    while($row8 = $result8->fetch_assoc()) {
        
     array_push($row1,$row8);


    }
    return $row1;
}
     else {
    echo "No New User found";
    }

    

}


function approveduser($conn)

{

    $sql08 = "SELECT * FROM tbl_user WHERE isblock=1 AND is_admin=1";
    $result08 = $conn->query($sql08);

    if ($result08->num_rows > 0) {
        $row1=array();
   
  
    while($row = $result08->fetch_assoc()) {
        
       
        
        array_push($row1,$row);
       

    }
   

    return $row1;
}
     else {
    echo "No New User found";
    }

    

   
}


function alluser($conn)

{

    $sql08 = "SELECT * FROM `tbl_user` WHERE `is_admin`=1";
    $result08 = $conn->query($sql08);

    if ($result08->num_rows > 0) {
        $row1=array();
   
  
    while($row = $result08->fetch_assoc()) {
        
       
        
        array_push($row1,$row);
       

    }
   

    return $row1;
}
     else {
    echo "No New User found";
    }

    

   
}


function completeride($conn)

{

    $sql08 = "SELECT * FROM `tbl_ride` WHERE `status`=2";
    $result08 = $conn->query($sql08);

    if ($result08->num_rows > 0) {
        $row1=array();
   
  
    while($row = $result08->fetch_assoc()) {
        
       
        
        array_push($row1,$row);
       

    }
   

    return $row1;
}
     else {
    echo "No New User found";
    }

    

   
}


function cancelride($conn)

{

    $sql08 = "SELECT * FROM `tbl_ride` WHERE `status`=0 OR `status`=3";
    $result08 = $conn->query($sql08);

    if ($result08->num_rows > 0) {
        $row1=array();
   
  
    while($row = $result08->fetch_assoc()) {
        
       
        
        array_push($row1,$row);
       

    }
   

    return $row1;
}
     else {
    echo "No New User found";
    }

    

   
}

function cancelridereq($id3,$conn)
{
    $sql = "UPDATE tbl_ride SET status=3 WHERE ride_id=".$id3."";
    if ($conn->query($sql) === TRUE) {
    echo '<script type="text/javascript">; 
    alert("Ride Cancel successfully"); 
    window.location= "newrequest.php";
    </script>';   
    } else {
    echo "Error updating record: " . $conn->error;
    }
}


function countnewrequest($conn)
{
    $sql="SELECT * FROM tbl_user WHERE isblock=0";
    $result08 = $conn->query($sql);
    $len=0;

    if ($result08->num_rows > 0) {
        
        $len=$result08->num_rows;
        return $len;
       

    }
   

    

     else {
    echo "No New User found";
    }

}

function countoldrequest($conn)
{
    $sql="SELECT * FROM tbl_user WHERE isblock=1";
    $result08 = $conn->query($sql);
    $len=0;

    if ($result08->num_rows > 0) {
        
        $len=$result08->num_rows;
        return $len;
       }
    else {
    echo "No New User found";
    }

}
function countnewriderequest($conn)
{

    $sql="SELECT * FROM tbl_ride WHERE status=1";
    $result08 = $conn->query($sql);
    $len=0;

    if ($result08->num_rows > 0) {
        
        $len=$result08->num_rows;
        return $len;
       }
    else {
    echo "No New User found";
    }

}
function countcompleteriderequest($conn)
{

    $sql="SELECT * FROM tbl_ride WHERE status=2";
    $result08 = $conn->query($sql);
    $len=0;

    if ($result08->num_rows > 0) {
        
        $len=$result08->num_rows;
        return $len;
       }
    else {
    echo "No New User found";
    }

}

function countlocationrequest($conn)

{

    $sql="SELECT * FROM tbl_location WHERE is_available=1";
    $result08 = $conn->query($sql);
    $len=0;

    if ($result08->num_rows > 0) {
        
        $len=$result08->num_rows;
        return $len;
       }
    else {
    echo "No New User found";
    }


}

function countcancelriderequest($conn)
{

    $sql="SELECT * FROM tbl_ride WHERE status=0 OR status=3";
    $result08 = $conn->query($sql);
    $len=0;

    if ($result08->num_rows > 0) {
        
        $len=$result08->num_rows;
        return $len;
       }
    else {
    echo "No New User found";
    }

}

function countalluserrequest($conn)
{
    $sql="SELECT * FROM tbl_user";
    $result08 = $conn->query($sql);
    $len=0;

    if ($result08->num_rows > 0) {
        
        $len=$result08->num_rows;
        return $len;
       }
    else {
    echo "No New User found";
    }
}

function counttotalearning($conn)

{


    $sql08 = "SELECT total_fare FROM `tbl_ride` WHERE `status`=2";
    $result08 = $conn->query($sql08);

    if ($result08->num_rows > 0) {
        $row1=0;
   
  
    while($row = $result08->fetch_assoc()) {
        
       
        
        $row1=$row1+$row['total_fare'];
       

    }
   

    return $row1;
}
     else {
    echo "No New User found";
    }



}

function filteradminnewuser($id1,$text,$conn)

{

    $row1=array();
    if($text!="none")
    {

    $sql = "SELECT * FROM tbl_user WHERE is_admin=1 AND isblock=0 ORDER BY ".$text." ASC";
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
elseif($text=="none")
{
    $sql = "SELECT * FROM tbl_user WHERE is_admin=1 AND isblock=0";
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





function filteradminapproveduser($id2,$text,$conn)
{

    $row1=array();
    if($text!="none")
    {

    $sql = "SELECT * FROM tbl_user WHERE is_admin=1 AND isblock=1 ORDER BY ".$text." ASC";
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
elseif($text=="none")
{
    $sql = "SELECT * FROM tbl_user WHERE is_admin=1 AND isblock=1";
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

function filteradminalluser($id3,$text,$conn)
{

    $row1=array();
    if($text!="none")
    {

    $sql = "SELECT * FROM tbl_user WHERE is_admin=1 ORDER BY ".$text." ASC";
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
elseif($text=="none")
{
    $sql = "SELECT * FROM tbl_user WHERE is_admin=1";
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

function filteradminnewrideuser($id4,$text,$conn)
{

    $row1=array();
    if($text!="none")
    {

    $sql = "SELECT * FROM tbl_ride WHERE status=1  ORDER BY ".$text." ASC";
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
elseif($text=="none")
{
    $sql = "SELECT * FROM tbl_ride WHERE status=1";
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

function filteradmincancelride($id5,$text,$conn)
{

    $row1=array();
    if($text!="none")
    {

    $sql = "SELECT * FROM tbl_ride WHERE status=0 OR status=3 ORDER BY ".$text." ASC";
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
elseif($text=="none")
{
    $sql = "SELECT * FROM tbl_ride WHERE status=0 OR status=3";
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



function filteradmincompleteride($id6,$text,$conn)

{


    $row1=array();
    if($text!="none")
    {

    $sql = "SELECT * FROM tbl_ride WHERE status=2 ORDER BY ".$text." ASC";
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
elseif($text=="none")
{
    $sql = "SELECT * FROM tbl_ride WHERE status=2";
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


function filterweek($id7,$value,$conn)


{

if($value=="week")
{
  $sql="SELECT * FROM tbl_ride WHERE ride_date > DATE_SUB(NOW(), INTERVAL 1 WEEK) AND status=1 ORDER BY total_fare ASC";
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

  $sql="SELECT * FROM tbl_ride WHERE ride_date > DATE_SUB(NOW(), INTERVAL 1 MONTH) AND status=1 ORDER BY total_fare ASC";
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

  $sql="SELECT * FROM tbl_ride WHERE ride_date > DATE_SUB(NOW(), INTERVAL 1 DAY) AND status=1 ORDER BY total_fare ASC";
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
  elseif($value=="none")
  {
    $sql7 = "SELECT * FROM `tbl_ride` WHERE `status`=1";
    $result7 = $conn->query($sql7);

    $row1=array();

    if ($result7->num_rows > 0) {
   
    while($row7 = $result7->fetch_assoc()) {

        array_push($row1,$row7);
        
     



    }
    return $row1;
}
     else {
    echo "No New User found";
    }
  

}


}
 function filterweekcanceluserrride($id8,$value,$conn)


 {


  if($value=="week")
{
  $sql="SELECT * FROM tbl_ride WHERE ride_date > DATE_SUB(NOW(), INTERVAL 1 WEEK) AND (status=0 or status=3) ORDER BY total_fare ASC";
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

  $sql="SELECT * FROM tbl_ride WHERE ride_date > DATE_SUB(NOW(), INTERVAL 1 MONTH) AND (status=0 OR status=3) ORDER BY total_fare ASC";
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

  $sql="SELECT * FROM tbl_ride WHERE ride_date > DATE_SUB(NOW(), INTERVAL 1 DAY) AND (status=0 OR status=3) ORDER BY total_fare ASC";
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

 elseif($value=="none")
 {


  $sql08 = "SELECT * FROM `tbl_ride` WHERE `status`=0 OR `status`=3";
  $result08 = $conn->query($sql08);

  if ($result08->num_rows > 0) {
      $row1=array();
 

  while($row = $result08->fetch_assoc()) {
      
     
      
      array_push($row1,$row);
     

  }
 

  return $row1;
}
   else {
  echo "No New User found";
  }

 }




 }


 function filtercompleterideadmin($id9,$value,$conn)

 {

  if($value=="week")
  {
    $sql="SELECT * FROM tbl_ride WHERE ride_date > DATE_SUB(NOW(), INTERVAL 1 WEEK) AND status=2 ORDER BY total_fare ASC";
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
  
    $sql="SELECT * FROM tbl_ride WHERE ride_date > DATE_SUB(NOW(), INTERVAL 1 MONTH) AND status=2  ORDER BY total_fare ASC";
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
  
    $sql="SELECT * FROM tbl_ride WHERE ride_date > DATE_SUB(NOW(), INTERVAL 1 DAY) AND status=2 ORDER BY total_fare ASC";
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


   elseif($value=="none")

   {

    $sql08 = "SELECT * FROM `tbl_ride` WHERE `status`=2";
    $result08 = $conn->query($sql08);

    if ($result08->num_rows > 0) {
        $row1=array();
   
  
    while($row = $result08->fetch_assoc()) {
        
       
        
        array_push($row1,$row);
       

    }
   

    return $row1;
}
     else {
    echo "No New User found";
    }

   }
  
 }


 function filternewuser($id10,$value,$conn)

 {


  $conn1=$conn;
  if($value=="week")
  {
    $sql="SELECT * FROM tbl_user WHERE dateofsignup > DATE_SUB(NOW(), INTERVAL 1 WEEK) AND isblock=0 ORDER BY user_name ASC";
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
  
    $sql="SELECT * FROM tbl_user WHERE dateofsignup > DATE_SUB(NOW(), INTERVAL 1 MONTH) AND isblock=0 ORDER BY user_name ASC";
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
  
    $sql="SELECT * FROM tbl_user WHERE dateofsignup > DATE_SUB(NOW(), INTERVAL 1 DAY) AND isblock=0 ORDER BY user_name ASC";
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

   else if($value=="none")
   {
     
    $row1=array();
    $sql = "SELECT * FROM tbl_user WHERE isblock=0";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
   
   
    while($row = $result->fetch_assoc()) {

        array_push($row1,$row);
       



    }

    return $row1;
}
     else {
    echo "No New User found";
    }
   }
  


 }



 function filterapproveduser($id11,$value,$conn)


 {




  if($value=="week")
  {
    $sql="SELECT * FROM tbl_user WHERE dateofsignup > DATE_SUB(NOW(), INTERVAL 1 WEEK) AND isblock=1 AND is_admin=1 ORDER BY user_name ASC";
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
  
    $sql="SELECT * FROM tbl_user WHERE dateofsignup > DATE_SUB(NOW(), INTERVAL 1 MONTH) AND isblock=1 AND is_admin=1 ORDER BY user_name ASC";
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
  
    $sql="SELECT * FROM tbl_user WHERE dateofsignup > DATE_SUB(NOW(), INTERVAL 1 DAY) AND isblock=1 AND is_admin=1 ORDER BY user_name ASC";
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

   else if($value=="none")
   {
    $sql08 = "SELECT * FROM tbl_user WHERE isblock=1 AND is_admin=1";
    $result08 = $conn->query($sql08);

    if ($result08->num_rows > 0) {
        $row1=array();
   
  
    while($row = $result08->fetch_assoc()) {
        
       
        
        array_push($row1,$row);
       

    }
   

    return $row1;
}
     else {
    echo "No New User found";
    }
   }
  



 }


 function filteralluser($id12,$value,$conn)
 {

  


  if($value=="week")
  {
    $sql="SELECT * FROM tbl_user WHERE dateofsignup > DATE_SUB(NOW(), INTERVAL 1 WEEK)  AND is_admin=1 ORDER BY user_name ASC";
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
  
    $sql="SELECT * FROM tbl_user WHERE dateofsignup > DATE_SUB(NOW(), INTERVAL 1 MONTH)  AND is_admin=1 ORDER BY user_name ASC";
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
  
    $sql="SELECT * FROM tbl_user WHERE dateofsignup > DATE_SUB(NOW(), INTERVAL 1 DAY)  AND is_admin=1 ORDER BY user_name ASC";
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


   elseif($value=="none")
   {


    $sql08 = "SELECT * FROM `tbl_user` WHERE `is_admin`=1";
    $result08 = $conn->query($sql08);

    if ($result08->num_rows > 0) {
        $row1=array();
   
  
    while($row = $result08->fetch_assoc()) {
        
       
        
        array_push($row1,$row);
       

    }
   

    return $row1;
}
     else {
    echo "No New User found";
    }

    

   }
  





 }


 function filtercompletecab($id31, $value, $conn)

 {



  if($value!="none")

  {


  $sql="SELECT * FROM tbl_ride WHERE `car`='".$value."' AND status=2";
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

  elseif($value=="none")

  {


    $sql08 = "SELECT * FROM `tbl_ride` WHERE `status`=2";
    $result08 = $conn->query($sql08);

    if ($result08->num_rows > 0) {
        $row1=array();
   
  
    while($row = $result08->fetch_assoc()) {
        
       
        
        array_push($row1,$row);
       

    }
   

    return $row1;
}
     else {
    echo "No New User found";
    }


  }



 }



 function filtercancelcab($id31, $value, $conn)

 {


if($value!="none")
{

  $sql="SELECT * FROM tbl_ride WHERE `car`='".$value."' AND (status=0 OR status=3)";
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

  elseif($value=="none")

  {


    $sql08 = "SELECT * FROM `tbl_ride` WHERE `status`=0 OR `status`=3";
    $result08 = $conn->query($sql08);

    if ($result08->num_rows > 0) {
        $row1=array();
   
  
    while($row = $result08->fetch_assoc()) {
        
       
        
        array_push($row1,$row);
       

    }
   

    return $row1;
}
     else {
    echo "No New User found";
    }

  }


 }




 function filternewcab($id31, $value, $conn)

 {


if($value!="none")
{

  $sql="SELECT * FROM tbl_ride WHERE `car`='".$value."' AND status=1";
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
  elseif($value=="none")
  {
    $sql08 = "SELECT * FROM `tbl_ride` WHERE `status`=1";
    $result08 = $conn->query($sql08);

    if ($result08->num_rows > 0) {
        $row1=array();
   
  
    while($row = $result08->fetch_assoc()) {
        
       
        
        array_push($row1,$row);
       

    }
   

    return $row1;
}
     else {
    echo "No New User found";
    }


  }



 }

 function blockuser($id50,$conn)

 {



  $sql = "UPDATE tbl_user SET isblock=0 WHERE user_id=".$id50."";
    if ($conn->query($sql) === TRUE) {
    echo '<script type="text/javascript">; 
    alert("User Block successfully"); 
    window.location= "approveduser.php";
    </script>';   
    } else {
    echo "Error updating record: " . $conn->error;
    }


 }


 function deleteuser($id52,$conn)
 {


  $sql = "DELETE FROM tbl_user WHERE user_id='".$id52."'";

if ($conn->query($sql) === TRUE) {
  echo '<script type="text/javascript">; 
    alert("User Deleted successfully"); 
    window.location= "viewnewuser.php";
    </script>';   
} else {
  echo "Error deleting record: " . $conn->error;
}



 }


 function viewinvoice($id54,$rid,$conn)

 {



  $sql="SELECT * FROM tbl_ride WHERE customer_user_id='".$id54."' AND ride_id='".$rid."'";
  $result = $conn->query($sql);

  $row1=array();
    
  if ($result->num_rows > 0) {
 
    while($row = $result->fetch_assoc()) {

      array_push($row1,$row);
    
    }
    return $row1;
  } 
  

 }


 function updateadmin($id, $conn)
 {
     $sql = "SELECT * FROM tbl_user WHERE user_id=" . $id . "";
     $result = $conn->query($sql);

     if ($result->num_rows > 0) {
         $row2 = array();
         while ($row = $result->fetch_assoc()) {
             array_push($row2, $row);
         }
         return $row2;
     } else {
         echo "0 results";
     }
 }

 function updateadmin2($id, $name, $mobile, $conn)
 {
     $sql =
         "UPDATE tbl_user SET name='" .
         $name .
         "' , mobile='" .
         $mobile .
         "' WHERE user_id=" .
         $id .
         "";

     if ($conn->query($sql) === true) {
         echo '<script type="text/javascript">; 
     alert("Update Done successfully"); 
     window.location= "updateadmin.php";
     </script>';
     } else {
         echo "Error updating record: " . $conn->error;
     }
 }

 function updateadminpass($id, $name, $newpass, $conpass, $conn)
 {
     $count = 0;
     $pass = md5($name);
     $newpass = md5($newpass);
     $conpass = md5($conpass);
     $sql = "SELECT `password` FROM `tbl_user` WHERE `user_id`=" . $id . "";
     $result = $conn->query($sql);

     if ($result->num_rows > 0) {
         while ($row = $result->fetch_assoc()) {
             $dbpass = $row['password'];
         }
         if ($pass == $dbpass) {
             $count = 1;
         } else {
             $count = 0;
         }
     }

     if ($count == 1 && $newpass == $conpass) {
         $sql2 =
             "UPDATE tbl_user SET password='" .
             $newpass .
             "' WHERE user_id=" .
             $id .
             "";

         if ($conn->query($sql2) === true) {
             echo '<script type="text/javascript">; 
         alert("Password Changed successfully ,Please relogin agn with new pass"); 
         window.location= "Logout.php";
         </script>';
         }
     } else {
         echo '<script type="text/javascript">; 
         alert("Password does not matched "); 
         window.location= "changeadminpass.php";
        
         </script>';
     }
 }




 function sortalluserride($id1,$text,$conn)

{

    $row1=array();
    if($text!="none")
    {

    $sql = "SELECT * FROM tbl_ride ORDER BY ".$text." ASC";
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
elseif($text=="none")
{
    $sql = "SELECT * FROM tbl_user WHERE is_admin=1 AND isblock=0";
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




function filteradminweek($id7,$value,$conn)


{

if($value=="week")
{
  $sql="SELECT * FROM tbl_ride WHERE ride_date > DATE_SUB(NOW(), INTERVAL 1 WEEK)  ORDER BY total_fare ASC";
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

  $sql="SELECT * FROM tbl_ride WHERE ride_date > DATE_SUB(NOW(), INTERVAL 1 MONTH)  ORDER BY total_fare ASC";
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

  $sql="SELECT * FROM tbl_ride WHERE ride_date > DATE_SUB(NOW(), INTERVAL 1 DAY)  ORDER BY total_fare ASC";
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
  elseif($value=="none")
  {
    $sql7 = "SELECT * FROM `tbl_ride`";
    $result7 = $conn->query($sql7);

    $row1=array();

    if ($result7->num_rows > 0) {
   
    while($row7 = $result7->fetch_assoc()) {

        array_push($row1,$row7);
        
     



    }
    return $row1;
}
     else {
    echo "No New User found";
    }
  

}


}





function filteradminnewcab($id31, $value, $conn)

{


if($value!="none")
{

 $sql="SELECT * FROM tbl_ride WHERE `car`='".$value."'";
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
 elseif($value=="none")
 {
   $sql08 = "SELECT * FROM `tbl_ride`";
   $result08 = $conn->query($sql08);

   if ($result08->num_rows > 0) {
       $row1=array();
  
 
   while($row = $result08->fetch_assoc()) {
       
      
       
       array_push($row1,$row);
      

   }
  

   return $row1;
}
    else {
   echo "No New User found";
   }


 }



}

function getname($id31,$conn)

{


 $sql="SELECT * FROM tbl_user WHERE `user_id`='".$id31."'";
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
?>

 







