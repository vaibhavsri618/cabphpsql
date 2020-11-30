<?php


require 'Dbconnect.php';

if(isset($_GET['id3']))

{
    $id3=$_GET['id3'];
    $admin=new adminwork();
    $dbcon=new Dbconnect();
    $admin->cancelridereq($id3,$dbcon->conn);
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

    

    echo '</tbody>
    </table>'; 
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
else
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
else
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
else
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

    $sql = "SELECT * FROM tbl_ride WHERE status=0  ORDER BY ".$text." ASC";
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
    $sql = "SELECT * FROM tbl_ride WHERE status=0";
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
else
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
else
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
  
 }


 function filternewuser($id10,$value,$conn)

 {



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
  





 }


 function filtercompletecab($id31, $value, $conn)

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



 function filtercancelcab($id31, $value, $conn)

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




 function filternewcab($id31, $value, $conn)

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






}
?>

 







