<?php 

include 'user.php';

if(isset($_SESSION['userdata']['username']))
{
$id=$_SESSION['userdata']['userid'];
?>


               



                <?php

                if(isset($_POST['id12']) && isset($_POST['text']))

                {
                    ?>

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
            
                </tr>
                <tbody>

        <?php
                $id12=$_POST['id12'];
             //   echo $id12;
                $text=$_POST['text'];
                $user=new user();
                $dbcon=new Dbconnect(); 
               $row1= $user->filteruser($id12,$text,$dbcon->conn);
              


                

               

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
                    
                    echo "<td>".$row['car']."</td>";
                    echo "<td>".$row['total_fare']."</td>"; 
                    echo "<td><a href='user.php?id5=".$id."&rideid=".$rideid."'>Cancel Ride</a></td>";
                }
            }



            if(isset($_POST['id13']) && isset($_POST['text']))

            {
                ?>

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
        <?php
            $id13=$_POST['id13'];
      
            $text=$_POST['text'];
            $user=new user();
            $dbcon=new Dbconnect(); 
           $row1= $user->filtercompleteuser($id13,$text,$dbcon->conn);
           $total=0;
          


            

           

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
                echo "<td>".$row['car']."</td>";
                echo "<td>".$row['total_fare']."</td>"; 
              
               
                $total=$total+$row['total_fare'];

            }
            ?>
            <tr><th colspan='6'>Your total spending till now</th>
            <th><?php echo $total ?></th>
          </tr>
       <?php }
          


                
                if(isset($_POST['id14']) && isset($_POST['text']))

                {
                    ?>

                    <table border="2px solid black">
                        
                        <tr>
                        
                        <th>Ride Date</th>
                        <th>Pick Up Point</th>
                        <th>Drop Point</th>
                        <th>Total Distance</th>
                        <th>Luggage</th>
                        <th>Car</th> 
                        <th>Total Fare</th> 
                      
                        <th>Cancel by</th>
                        
                    
                        </tr>
                        <tbody>
                <?php
                $id14=$_POST['id14'];

                $text=$_POST['text'];
                $user=new user();
                $dbcon=new Dbconnect(); 
                $row1= $user->filtercanceluser($id14,$text,$dbcon->conn);
              






                foreach($row1 as $key=>$row)
                {

                    if($row['status']==3)
                    $can="admin";
                    elseif($row['status']==0)
                    $can="You";


                    if($row['luggage']=="")
                    $luggage=0;
                    else
                    $luggage=$row['luggage'];


                    echo "<tr>";
                    echo "<td>".$row['ride_date']."</td>";
                    echo "<td>".$row['from_distance']."</td>";
                    echo "<td>".$row['to_distance']."</td>";
                    echo "<td>".$row['total_distance']."</td>";
                    echo "<td>".$luggage."</td>";  
                    echo "<td>".$row['car']."</td>";
                    echo "<td>".$row['total_fare']."</td>"; 
                
                
                    echo "<td>".$can."</td>";

                }
               }



                    


                if(isset($_POST['id15']) && isset($_POST['text']))

                {
                    ?>

                    <table border="2px solid black">
                        
                        <tr>
                        
                        <th>Ride Date</th>
                        <th>Pick Up Point</th>
                        <th>Drop Point</th>
                        <th>Total Distance</th>
                        <th>Luggage</th>
                        <th>Car</th> 
                        <th>Total Fare</th> 
                    
                       
                        
                    
                        </tr>
                        <tbody>
                <?php
                $id15=$_POST['id15'];

                $text=$_POST['text'];
                $user=new user();
                $dbcon=new Dbconnect(); 
                $row1= $user->filteralluser($id15,$text,$dbcon->conn);







                foreach($row1 as $key=>$row)
                {

                    

                    if($row['luggage']=="")
                    $luggage=0;
                    else
                    $luggage=$row['luggage'];


                    echo "<tr>";
                    echo "<td>".$row['ride_date']."</td>";
                    echo "<td>".$row['from_distance']."</td>";
                    echo "<td>".$row['to_distance']."</td>";
                    echo "<td>".$row['total_distance']."</td>";
                    echo "<td>".$luggage."</td>";  
                    echo "<td>".$row['car']."</td>";
                    echo "<td>".$row['total_fare']."</td>"; 


                  

                }
                }



                if(isset($_POST['id11']) && isset($_POST['value']))

                {
                    $id11=$_POST['id11'];
                    $value=$_POST['value'];
                    
                    ?>
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
                    $row1=$admin->filterapproveduser($id11,$value,$dbconnect->conn);
                    if($row1!="")
                    {
            
                
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
                        }
                    }
            
              
        
                    if(isset($_POST['id13']) && isset($_POST['value']))
        
                    {
                        $id20=$_POST['id13'];
                        $value=$_POST['value'];

               
                        
                        ?>
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
                    
                       $user=new user();
                        $dbconnect=new Dbconnect();
                        $row1=$user->filteruserride($id20,$value,$dbconnect->conn);
                        if($row1!="")
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
                        }
                            }
                        }



                        if(isset($_POST['id14']) && isset($_POST['value']))
        
                        {
                            $id21=$_POST['id14'];
                            $value=$_POST['value'];
    
                   
                            
                            ?>
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
                        </tr>
                        <tbody>
                                    
                            <?php
                        
                           $user=new user();
                            $dbconnect=new Dbconnect();
                            $row1=$user->filteruserpendingride($id21,$value,$dbconnect->conn);
                            if($row1!="")
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
                            }
                                }
                            }
                    
                            if(isset($_POST['id15']) && isset($_POST['value']))
        
                            {
                                $id22=$_POST['id15'];
                                $value=$_POST['value'];
        
                       
                                
                                ?>
                            <table border="2px solid black">
                            
                            <tr>
                            
                          
                    <th>Ride Date</th>
                    <th>Pick Up Point</th>
                    <th>Drop Point</th>
                    <th>Total Distance</th>
                    <th>Luggage</th>
                   
                    <th>Car</th> 
                    <th>Total Fare</th> 
                  
                  
                            </tr>
                            <tbody>
                                        
                                <?php

                                $total=0;
                            
                               $user=new user();
                                $dbconnect=new Dbconnect();
                                $row1=$user->filterusercompletedride($id22,$value,$dbconnect->conn);
                                if($row1!="")
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
                                    echo "<td>".$row['car']."</td>";
                                    echo "<td>".$row['total_fare']."</td>"; 
                                  
                                    $total=$total+$row['total_fare'];
                 }

                                    ?> 
                                    <tr><th colspan='6'>Your total spending till now</th>
                                    <th><?php echo $total ?></th>
                                    </tr>
                                </tbody>
                                </table>

                                <?php
                                    }
                                }


                                if(isset($_POST['id16']) && isset($_POST['value']))
        
                                {
                                    $id22=$_POST['id16'];
                                    $value=$_POST['value'];
            
                           
                                    
                                    ?>
                               <table border="2px solid black">
    
                                    <tr>
                                    
                                    <th>Ride Date</th>
                                    <th>Pick Up Point</th>
                                    <th>Drop Point</th>
                                    <th>Total Distance</th>
                                    <th>Luggage</th>
                                    <th>Total Fare</th> 
                                    <th>Car</th> 
                                    <th>Cancel By</th>
                                
                                    </tr>
                                    <tbody>
                                            
                                    <?php
                                
                                   $user=new user();
                                    $dbconnect=new Dbconnect();
                                    $row1=$user->filterusercancelride($id22,$value,$dbconnect->conn);
                                    if($row1!="")
                                    {
                            
                                
                                    foreach($row1 as $key=>$row)
                                    {
                            
                                        if($row['status']==3)
                                        $can="admin";
                                        elseif($row['status']==0)
                                        $can="You";
                    
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
                                        echo "<td>".$row['car']."</td>";
                    
                                        echo "<td>".$row['total_fare']."</td>"; 
                    
                                       
                                        echo "<td>".$can."</td>";               }
                                        }
                                    }





if (isset($_POST['id31']) && isset($_POST['value']))

{
    $id31 = $_POST['id31'];
    $value = $_POST['value'];
   
?>
        <table border="2px solid black">
    
    <tr>
    
    <th>Ride Date</th>
    <th>Pick Up Point</th>
    <th>Drop Point</th>
    <th>Total Distance</th>
    <th>Luggage</th>
   
    <th>Car</th> 
    <th>Total Fare</th> 
  
  
    </tr>
    <tbody>

        
    
    
        </tr>
        <tbody>
                        
            <?php
    $user = new user();
    $dbconnect = new Dbconnect();
    $row1 = $user->filtercompletecab($id31, $value, $dbconnect->conn);
    $total=0;
    if ($row1 != "")
    {

        foreach ($row1 as $key => $row)
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
                    echo "<td>".$row['car']."</td>";
                    echo "<td>".$row['total_fare']."</td>"; 
                  
                    $total=$total+$row['total_fare'];

        }

        ?> 
        <tr><th colspan='6'>Your total Spending till now</th>
        <th><?php echo $total ?></th>
      </tr>
         <?php
    }
}



if (isset($_POST['id32']) && isset($_POST['value']))

{
    $id32 = $_POST['id32'];
    $value = $_POST['value'];
   
?>
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
  
    </tr>
    <tbody>

        
    
    
                        
            <?php
    $user = new user();
    $dbconnect = new Dbconnect();
    $row1 = $user->filterpendingcab($id32, $value, $dbconnect->conn);
    $total=0;
    if ($row1 != "")
    {

        foreach ($row1 as $key => $row)
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

     
        }

        
    }
}


if (isset($_POST['id33']) && isset($_POST['value']))

{
    $id33 = $_POST['id33'];
    $value = $_POST['value'];
   
?>
      
      <table border="2px solid black">
    
    <tr>
    
    <th>Ride Date</th>
    <th>Pick Up Point</th>
    <th>Drop Point</th>
    <th>Total Distance</th>
    <th>Luggage</th>
    <th>Total Fare</th> 
    <th>Car</th> 
    <th>Cancel By</th>
  
    </tr>
    <tbody>
    
    
              
            <?php
    $user = new user();
    $dbconnect = new Dbconnect();
    $row1 = $user->filtercancelcab($id33, $value, $dbconnect->conn);
    $total=0;
    if ($row1 != "")
    {

        foreach ($row1 as $key => $row)
        {

         
            if($row['status']==3)
                    $can="admin";
                    elseif($row['status']==0)
                    $can="You";

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
                    echo "<td>".$row['car']."</td>";

                    echo "<td>".$row['total_fare']."</td>"; 

                   
                    echo "<td>".$can."</td>";
                   
        }

        
    }
}


if (isset($_POST['id34']) && isset($_POST['value']))

{
    $id34 = $_POST['id34'];
    $value = $_POST['value'];
   
?>
      
    
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

        
    
    
                        
            <?php
    $user = new user();
    $dbconnect = new Dbconnect();
    $row1 = $user->filterallcab($id34, $value, $dbconnect->conn);
    $total=0;
    if ($row1 != "")
    {

        foreach ($row1 as $key => $row)
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

        
    }
}
                         
                        


              



}
else
{
    echo 'Please Login,first to continue <a href="login2.php">Click here to login</a>';
}
?>