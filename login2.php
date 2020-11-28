
<?php


require 'user.php';
$error=array();

if (isset($_POST['submit'])) {
    $name=isset($_POST['username'])?$_POST['username']:'';
    $password=isset($_POST['password'])?$_POST['password']:'';
    $password=md5($password);


    $user=new user();
    $connection=new Dbconnect();

    $show=$user->Login($name,$password,$connection->conn);
    
    echo $show;




}

?>



<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
    </head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <body>
    <h1 style="text-align: center;padding: 20px;font-style: italic;">Login</h1>
        
    <h4 id='error'><?php 
    if (count($error)>0) {
    
        echo $display; 
    } ?></h4>
        <div id="form">
        <form action="#" method="POST">
            <label><b>UserName:</b></label>
            <input type="text" name="username" id="user7" placeholder="Username"><br>
            <label><b>Password:</b></label>
            <input type="password" name="password"
             id="user2" placeholder="Password"><br>
            <input type="submit" name="submit" value="Submit" id="submit"><br>
            <br>
            <p style="font-size:30px">New user , <a href="registration2.php">Click here to register yourself</a>
      
        </form>
    </div>
    </body>
</html>