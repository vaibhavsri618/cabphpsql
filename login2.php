
<?php


require 'user.php';
$error=array();
if(isset($_SESSION['userdata']['name']))
{


  header("Location:Logout.php");
}

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
                
                 
                  <a href="registration2.php" style="padding-left: 10px;">Registration</a>
                 
                </form>
               
                
              </ul>
              
            </div>
          </nav>
    </header>
    <div class="register">    
    <h4 id='error'><?php 
    if (count($error)>0) {
    
        echo $display; 
    } ?></h4>
  
        <form class="form" action="#" method="POST">
          <h1 style="text-align:center">Login Here</h1><hr>
            <label><b>UserName:</b></label>
            <input type="text" name="username" id="user7" placeholder="Username" value=<?php 
              if(isset($_COOKIE['user'])) {
                  echo $_COOKIE['user'];
              }  ?>><br>
            <label><b>Password:</b></label>
            <input type="password" name="password"
             id="user2" placeholder="Password"><br>
            <input type="submit" name="submit" value="Submit" id="submit"><br>
            <br>
              
          
        </form>
    </div>
    </body>
</html>