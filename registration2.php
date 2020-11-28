<?php


require 'user.php';

$error=array();
if (isset($_POST['submit'])) {
    $username=isset($_POST['email'])?$_POST['email']:"";
    $name=isset($_POST['name'])?$_POST['name']:"";
    $password=isset($_POST['password'])?$_POST['password']:"";
    $confirmpassword=isset($_POST['confirmpassword'])?$_POST['confirmpassword']:"";
    $phone=isset($_POST['phone'])?$_POST['phone']:"";
    date_default_timezone_set("Asia/Calcutta");

    $date=date("Y-m-d h:i:s");

    $user=new user();
    $connection=new Dbconnect();

    $show=$user->register($username,$password,$name,$confirmpassword,$phone,$date,$connection->conn);
    echo $show;
}


?>




<!DOCTYPE html>
<html>
    <head>
        <title>Registration</title>
    </head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <body>
    <h1 style="text-align: center;padding: 20px;font-style: italic;">
    Welcome , Please Fill the Form to Register Youself</h1>
        
    <h4 id='error'><?php 
    if (count($error)>0) {
    
        echo $display; 
    } ?></h4>
        <div id="form">
        <form action="#" method="POST">
            <label><b>Email:</b></label>
            <input type="email" name="email" id="user" placeholder="Email"><br>
            <label><b>Name:</b></label>
            <input type="text" name="name" id="user5" placeholder="Name"><br>
            <label><b>Password:</b></label>
            <input type="password" name="password"
             id="user2" placeholder="Password"><br>
            <label><b>Confirm Password:</b></label>
            <input type="password" name="confirmpassword" 
            id="user1" placeholder="Confirm Password"><br>
            <label><b>Mobile No:</b></label>
            <input type="number" name="phone" id="user4" placeholder="Mobile"><br><br>
            <input type="submit" name="submit" value="Submit" id="submit">
      
        </form>
        <br>
        <h2><a href="login2.php"><b>Already a user , Click here to login<b></a></h2>
    </div>
    </body>
</html>