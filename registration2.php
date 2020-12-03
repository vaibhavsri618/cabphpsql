<?php


require 'user.php';

$error=array();
if (isset($_POST['submit'])) {
    $username=isset($_POST['email'])?$_POST['email']:"";
    $name=isset($_POST['name'])?$_POST['name']:"";
    $password=md5(isset($_POST['password'])?$_POST['password']:"");
    $confirmpassword=md5(isset($_POST['confirmpassword'])?$_POST['confirmpassword']:"");
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="cab.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
               
    <script src="https://kit.fontawesome.com/4b2ee26aaa.js" crossorigin="anonymous"></script>
  
    <body>
    


<header>
        <nav class="navbar navbar-expand-lg navbar-light">
            <h2>Ced<span style="color: #CDDC39;">Cab</span></h2>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
          
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav ml-auto">
              

                <form class="form-inline my-2 my-lg-0">
                <a href="index.php" style="padding-right: 10px;">Home</a>
                
                 
                  <a href="login2.php" style="padding-left: 10px;">Login</a>
                 
                </form>
               
                
              </ul>
              
            </div>
          </nav>
    </header>
     <body>
    
  
    <div class="register">   
    <h4 id='error'><?php 
    if (count($error)>0) {
    
        echo $display1; 
    } ?></h4>
       
        <form class="form" action="#" method="POST">
          <h1 style="text-align:center">Register Here</h1>
          <hr>
            <label><b>Email:</b></label>
            <input type="email" name="email" id="user" placeholder="Email"><br>
            <label><b>Name:</b></label>
            <input type="text" name="name" id="user5" placeholder="Name" pattern="^[a-zA-Z_]+( [a-zA-Z_]+)*$"><br>
            <label><b>Password:</b></label>
            <input type="password" name="password"
             id="user2" placeholder="Password"><br>
            <label><b>Confirm Password:</b></label>
            <input type="password" name="confirmpassword" 
            id="user1" placeholder="Confirm Password"><br>
            <label><b>Mobile No:</b></label>
            <input type="text" name="phone" id="mobile" placeholder="Mobile"><br><br>
            <input type="submit" name="submit" value="Submit" id="submit1">
      
        </form>
        <br>
     
   
  </div>
  <script src="cab.js"></script>
    </body>
</html>