<?php
include 'adminwork.php';

if (isset($_POST['id1']) && isset($_POST['text']))

{
    $id1 = $_POST['id1'];
    $text = $_POST['text'];
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
    $admin = new adminwork();
    $dbconnect = new Dbconnect();
    $row1 = $admin->filteradminnewuser($id1, $text, $dbconnect->conn);
    if ($row1 != "")
    {

        foreach ($row1 as $key => $row)
        {

            echo "<tr>";
            echo "<td>" . $row['user_id'] . "</td>";
            echo "<td>" . $row['user_name'] . "</td>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['dateofsignup'] . "</td>";
            echo "<td>" . $row['mobile'] . "</td>";
            echo "<td><a href='confirmuser.php?id=" . $row['user_id'] . "'>Yes</a> / <a href='#'>No</a></td>";
        }
    }
}

if (isset($_POST['id3']) && isset($_POST['text']))

{
    $id3 = $_POST['id3'];
    $text = $_POST['text'];
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
    $admin = new adminwork();
    $dbconnect = new Dbconnect();
    $row1 = $admin->filteradminalluser($id3, $text, $dbconnect->conn);
    if ($row1 != "")
    {

        foreach ($row1 as $key => $row)
        {

            echo "<tr>";
            echo "<td>" . $row['user_id'] . "</td>";
            echo "<td>" . $row['user_name'] . "</td>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['dateofsignup'] . "</td>";
            echo "<td>" . $row['mobile'] . "</td>";
            echo "<td><a href='confirmuser.php?id=" . $row['user_id'] . "'>Yes</a> / <a href='#'>No</a></td>";
        }
    }

}

if (isset($_POST['id2']) && isset($_POST['text']))

{
    $id2 = $_POST['id2'];
    $text = $_POST['text'];
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
    $admin = new adminwork();
    $dbconnect = new Dbconnect();
    $row1 = $admin->filteradminapproveduser($id2, $text, $dbconnect->conn);
    if ($row1 != "")
    {

        foreach ($row1 as $key => $row)
        {

            echo "<tr>";
            echo "<td>" . $row['user_id'] . "</td>";
            echo "<td>" . $row['user_name'] . "</td>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['dateofsignup'] . "</td>";
            echo "<td>" . $row['mobile'] . "</td>";
            echo "<td><a href='confirmuser.php?id=" . $row['user_id'] . "'>Yes</a> / <a href='#'>No</a></td>";
        }
    }

}

if (isset($_POST['id4']) && isset($_POST['text']))

{
    $id4 = $_POST['id4'];
    $text = $_POST['text'];
?>
        
    
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
            </tr>
            <tbody>
        
            <?php
    $admin = new adminwork();
    $dbconnect = new Dbconnect();
    $row1 = $admin->filteradminnewrideuser($id4, $text, $dbconnect->conn);

    if ($row1 != "")
    {

        foreach ($row1 as $key => $row7)
        {

            if ($row7['luggage'] == "") $luggage = 0;
            else $luggage = $row7['luggage'];

            echo "<tr>";
            echo "<td>" . $row7['ride_id'] . "</td>";
            echo "<td>" . $row7['ride_date'] . "</td>";
            echo "<td>" . $row7['from_distance'] . "</td>";
            echo "<td>" . $row7['to_distance'] . "</td>";
            echo "<td>" . $row7['total_distance'] . "</td>";
            echo "<td>" . $luggage . "</td>";
            echo "<td>" . $row7['total_fare'] . "</td>";
            echo "<td>" . $row7['customer_user_id'] . "</td>";
            echo "<td>" . $row7['car'] . "</td>";
            echo "<td><a href='confirmride.php?id=" . $row7['ride_id'] . "'>Yes</a> / 
                <a href='adminwork.php?id3=" . $row7['ride_id'] . "'>No</a></td>";

        }
    }
}

if (isset($_POST['id5']) && isset($_POST['text']))

{
    $id5 = $_POST['id5'];
    $text = $_POST['text'];

?>
                
                <table border="2px solid black" style="margin-right:20px;margin-top:10px">
    
                <tr>
                
                <th>Rideid</th>
                <th>Date</th>
                <th>From</th>
                <th>To</th>
                <th>Distance</th>
                <th>Luggage</th> 
                <th>Total Fare</th>   
                <th>Customer id</th> 
                <th>Car</th> 
                <th>Cancel by</th>
            
            
                </tr>
                <tbody>
                
        <?php
    $admin = new adminwork();
    $dbconnect = new Dbconnect();
    $row1 = $admin->filteradmincancelride($id5, $text, $dbconnect->conn);
    if ($row1 != "")
    {

        foreach ($row1 as $key => $row)
        {

            if ($row['status'] == 3) $can = "You";
            elseif ($row['status'] == 0) $can = "User";

            if ($row['luggage'] == "") $luggage = 0;
            else $luggage = $row['luggage'];

            echo "<tr>";
            echo "<td>" . $row['ride_id'] . "</td>";
            echo "<td>" . $row['ride_date'] . "</td>";
            echo "<td>" . $row['from_distance'] . "</td>";
            echo "<td>" . $row['to_distance'] . "</td>";
            echo "<td>" . $row['total_distance'] . "</td>";
            echo "<td>" . $luggage . "</td>";
            echo "<td>" . $row['total_fare'] . "</td>";
            echo "<td>" . $row['customer_user_id'] . "</td>";
            echo "<td>" . $row['car'] . "</td>";
            echo "<td>" . $can . "</td>";

        }
    }
}

if (isset($_POST['id6']) && isset($_POST['text']))

{
    $id6 = $_POST['id6'];
    $text = $_POST['text'];

?>
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
    $admin = new adminwork();
    $dbconnect = new Dbconnect();
    $row1 = $admin->filteradmincompleteride($id6, $text, $dbconnect->conn);
    $total = 0;

    if ($row1 != "")
    {

        foreach ($row1 as $key => $row)
        {

            if ($row['luggage'] == "") $luggage = 0;
            else $luggage = $row['luggage'];

            echo "<tr>";
            echo "<td>" . $row['ride_id'] . "</td>";
            echo "<td>" . $row['ride_date'] . "</td>";
            echo "<td>" . $row['from_distance'] . "</td>";
            echo "<td>" . $row['to_distance'] . "</td>";
            echo "<td>" . $row['total_distance'] . "</td>";
            echo "<td>" . $luggage . "</td>";

            echo "<td>" . $row['customer_user_id'] . "</td>";
            echo "<td>" . $row['car'] . "</td>";
            echo "<td>" . $row['total_fare'] . "</td>";

            $total = $total + $row['total_fare'];

        }
?> 
                <tr><th colspan='8'>Your total Earning till now</th>
                <th><?php echo $total ?></th>
                </tr>
                <?php
    }

}

if (isset($_POST['id7']) && isset($_POST['value']))

{
    $id7 = $_POST['id7'];
    $value = $_POST['value'];
    // echo $value;
    
?>
                    
                
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
                        </tr>
                        <tbody>
                    
                        <?php
    $admin = new adminwork();
    $dbconnect = new Dbconnect();
    $row1 = $admin->filterweek($id7, $value, $dbconnect->conn);
    if ($row1 != "")
    {

        foreach ($row1 as $key => $row7)
        {

            if ($row7['luggage'] == "") $luggage = 0;
            else $luggage = $row7['luggage'];

            echo "<tr>";
            echo "<td>" . $row7['ride_id'] . "</td>";
            echo "<td>" . $row7['ride_date'] . "</td>";
            echo "<td>" . $row7['from_distance'] . "</td>";
            echo "<td>" . $row7['to_distance'] . "</td>";
            echo "<td>" . $row7['total_distance'] . "</td>";
            echo "<td>" . $luggage . "</td>";
            echo "<td>" . $row7['total_fare'] . "</td>";
            echo "<td>" . $row7['customer_user_id'] . "</td>";
            echo "<td>" . $row7['car'] . "</td>";
            echo "<td><a href='confirmride.php?id=" . $row7['ride_id'] . "'>Yes</a> / 
                            <a href='adminwork.php?id3=" . $row7['ride_id'] . "'>No</a></td>";

        }
    }
}

if (isset($_POST['id8']) && isset($_POST['value']))

{
    $id8 = $_POST['id8'];
    $value = $_POST['value'];
    // echo $value;
    
?>
                            
                        
                            <table border="2px solid black" style="margin-right:20px;margin-top:10px">
                                    
                                    <tr>
                                    
                                    <th>Rideid</th>
                                    <th>Date</th>
                                    <th>From</th>
                                    <th>To</th>
                                    <th>Distance</th>
                                    <th>Luggage</th> 
                                    <th>Total Fare</th>   
                                    <th>Customer id</th> 
                                    <th>Car</th> 
                                    <th>Cancel by</th>
                                
                                
                                    </tr>
                                    <tbody>
                            
                                <?php
    $admin = new adminwork();
    $dbconnect = new Dbconnect();
    $row1 = $admin->filterweekcanceluserrride($id8, $value, $dbconnect->conn);

    if ($row1 != "")
    {
        foreach ($row1 as $key => $row)
        {

            if ($row['status'] == 3) $can = "You";
            elseif ($row['status'] == 0) $can = "User";

            if ($row['luggage'] == "") $luggage = 0;
            else $luggage = $row['luggage'];

            echo "<tr>";
            echo "<td>" . $row['ride_id'] . "</td>";
            echo "<td>" . $row['ride_date'] . "</td>";
            echo "<td>" . $row['from_distance'] . "</td>";
            echo "<td>" . $row['to_distance'] . "</td>";
            echo "<td>" . $row['total_distance'] . "</td>";
            echo "<td>" . $luggage . "</td>";
            echo "<td>" . $row['total_fare'] . "</td>";
            echo "<td>" . $row['customer_user_id'] . "</td>";
            echo "<td>" . $row['car'] . "</td>";
            echo "<td>" . $can . "</td>";

        }
    }
}

if (isset($_POST['id9']) && isset($_POST['value']))

{
    $id9 = $_POST['id9'];
    $value = $_POST['value'];
    // echo $value;
    
?>
                                
                            
                                        
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
    $admin = new adminwork();
    $dbconnect = new Dbconnect();
    $row1 = $admin->filtercompleterideadmin($id9, $value, $dbconnect->conn);
    if ($row1 != "")
    {
        $total = 0;

        foreach ($row1 as $key => $row)
        {

            if ($row['luggage'] == "") $luggage = 0;
            else $luggage = $row['luggage'];

            echo "<tr>";
            echo "<td>" . $row['ride_id'] . "</td>";
            echo "<td>" . $row['ride_date'] . "</td>";
            echo "<td>" . $row['from_distance'] . "</td>";
            echo "<td>" . $row['to_distance'] . "</td>";
            echo "<td>" . $row['total_distance'] . "</td>";
            echo "<td>" . $luggage . "</td>";

            echo "<td>" . $row['customer_user_id'] . "</td>";
            echo "<td>" . $row['car'] . "</td>";
            echo "<td>" . $row['total_fare'] . "</td>";

            $total = $total + $row['total_fare'];
        }

?> 
                                            <tr><th colspan='8'>Your total Earning till now</th>
                                            <th><?php echo $total ?></th>
                                          </tr>
                                     <?php
    }
}

if (isset($_POST['id10']) && isset($_POST['value']))

{
    $id10 = $_POST['id10'];
    $value = $_POST['value'];

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
    $admin = new adminwork();
    $dbconnect = new Dbconnect();
    $row1 = $admin->filternewuser($id10, $value, $dbconnect->conn);
    if ($row1 != "")
    {

        foreach ($row1 as $key => $row)
        {

            echo "<tr>";
            echo "<td>" . $row['user_id'] . "</td>";
            echo "<td>" . $row['user_name'] . "</td>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['dateofsignup'] . "</td>";
            echo "<td>" . $row['mobile'] . "</td>";
            echo "<td><a href='confirmuser.php?id=" . $row['user_id'] . "'>Yes</a> / <a href='#'>No</a></td>";

        }
    }
}

if (isset($_POST['id11']) && isset($_POST['value']))

{
    $id11 = $_POST['id11'];
    $value = $_POST['value'];

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
    $admin = new adminwork();
    $dbconnect = new Dbconnect();
    $row1 = $admin->filterapproveduser($id11, $value, $dbconnect->conn);
    if ($row1 != "")
    {

        foreach ($row1 as $key => $row)
        {

            echo "<tr>";
            echo "<td>" . $row['user_id'] . "</td>";
            echo "<td>" . $row['user_name'] . "</td>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['dateofsignup'] . "</td>";
            echo "<td>" . $row['mobile'] . "</td>";
            echo "<td><a href='confirmuser.php?id=" . $row['user_id'] . "'>Yes</a> / <a href='#'>No</a></td>";

        }
    }
}

if (isset($_POST['id12']) && isset($_POST['value']))

{
    $id12 = $_POST['id12'];
    $value = $_POST['value'];

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
    $admin = new adminwork();
    $dbconnect = new Dbconnect();
    $row1 = $admin->filteralluser($id12, $value, $dbconnect->conn);
    if ($row1 != "")
    {

        foreach ($row1 as $key => $row)
        {

            echo "<tr>";
            echo "<td>" . $row['user_id'] . "</td>";
            echo "<td>" . $row['user_name'] . "</td>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['dateofsignup'] . "</td>";
            echo "<td>" . $row['mobile'] . "</td>";
            echo "<td><a href='confirmuser.php?id=" . $row['user_id'] . "'>Yes</a> / <a href='#'>No</a></td>";

        }
    }
}



if (isset($_POST['id31']) && isset($_POST['value']))

{
    $id31 = $_POST['id31'];
    $value = $_POST['value'];
   
?>
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
    $admin = new adminwork();
    $dbconnect = new Dbconnect();
    $row1 = $admin->filtercompletecab($id31, $value, $dbconnect->conn);
    $total=0;
    if ($row1 != "")
    {

        foreach ($row1 as $key => $row)
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
         <?php
    }
}



if (isset($_POST['id32']) && isset($_POST['value']))

{
    $id32 = $_POST['id32'];
    $value = $_POST['value'];
   
?>
         <table border="2px solid black" style="margin-right:20px;margin-top:10px">
    
    <tr>
    
    <th>Rideid</th>
    <th>Date</th>
    <th>From</th>
    <th>To</th>
    <th>Distance</th>
    <th>Luggage</th> 
    <th>Total Fare</th>   
    <th>Customer id</th> 
    <th>Car</th> 
    <th>Cancel by</th>
  
  
    </tr>
    <tbody>

        
    
    
        </tr>
        <tbody>
                        
            <?php
    $admin = new adminwork();
    $dbconnect = new Dbconnect();
    $row1 = $admin->filtercancelcab($id32, $value, $dbconnect->conn);
    $total=0;
    if ($row1 != "")
    {

        foreach ($row1 as $key => $row)
        {

         
            if($row['status']==3)
                $can="You";
                elseif($row['status']==0)
                $can="User";

                if($row['luggage']=="")
                $luggage=0;
                else
                $luggage=$row['luggage'];


                echo "<tr>";
                echo "<td>".$row['ride_id']."</td>";
                echo "<td>".$row['ride_date']."</td>";
                echo "<td>".$row['from_distance']."</td>";
                echo "<td>".$row['to_distance']."</td>";
                echo "<td>".$row['total_distance']."</td>";
                echo "<td>".$luggage."</td>";  
                echo "<td>".$row['total_fare']."</td>"; 
                echo "<td>".$row['customer_user_id']."</td>";
                echo "<td>".$row['car']."</td>";
                echo "<td>".$can."</td>";
     
        }

        
    }
}



if (isset($_POST['id33']) && isset($_POST['value']))

{
    $id33 = $_POST['id33'];
    $value = $_POST['value'];
   
?>
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
    </tr>
    <tbody>
        
    
    
        </tr>
        <tbody>
                        
            <?php
    $admin = new adminwork();
    $dbconnect = new Dbconnect();
    $row1 = $admin->filternewcab($id33, $value, $dbconnect->conn);
    $total=0;
    if ($row1 != "")
    {

        foreach ($row1 as $key => $row7)
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
    
        }

        
    }
}





?>
