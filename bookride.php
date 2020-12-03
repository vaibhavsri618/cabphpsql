
<?php



include 'user.php';

if(!isset($_SESSION['book']))
{

}
else
{
$drop2=$_SESSION['book']['to'];
$pick2=$_SESSION['book']['from'];
$cars2=$_SESSION['book']['cars'];
$weight2=$_SESSION['book']['weight'];

}
if(isset($_SESSION['userdata']['name']))
{
if($_SESSION['userdata']['name']!="admin")
{
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="cab.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
               
    <script src="https://kit.fontawesome.com/4b2ee26aaa.js" crossorigin="anonymous"></script>
   
   
    <title>Cab Service</title>
</head>
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
              
                <span style="margin-right:500px"><b>Welcome <?php
                echo $_SESSION['userdata']['name']
                ?></b></span>
                  <span style="margin-left:10px"><a href="homeuser.php">Home</a><span>
                <a href="Logout.php" style="margin-left:10px">Logout</a>
                </form>
               
                
              </ul>
              
            </div>
          </nav>
    </header>
    <section class="container-fluid mb-5 ">
        <h1 class="text-center mt-5" id="head">Book a City Taxi to Your destination in Town</h1>
        <p class="text-center" id="phead">Choose from a range of category and price</p>
        <div class="main mb-5 ml-lg-5 ml-md-5 mt-3 col-sm-8 col-xs-8 col-lg-4 col-md-8 maindiv">
            <div class="text-center py-2" id="buttondiv">
            <input type="button" class="btn btn-primary btn-sm" value="CedCab" id="button1">
        </div>
          <div class="container-fluid col-lg-12 col-sm-12 col-xs-12 col-md-12">
            <p class="text-center mt-3 mb-0"><b>Your Everyday Travel Partner</b></p>
            <p class="text-center">A.C Cab for Point to Point Travel</p>

            <form method="post" action="homeuser.php">

              <?php
                if(isset($_SESSION['book']))
                {

                ?>
                   
                <div class="form-group row input ml-1 mr-1">
                    <label class="col-sm-3 col-md-3 col-lg-3 col-xs-3 mt-2">PickUp</label>
                    <select name="pick" id="pick" class="col-sm-9 col-md-9 col-xs-9 col-lg-9 input sel form-control-plaintext">
                        
                        <option value="<?php echo $pick2?>"><?php echo $pick2?></option>
                        
                        <?php

                            $user=new user();
                            $dbconnect=new Dbconnect();
                            $row1=$user->home($dbconnect->conn);
                            foreach($row1 as $key=>$row)
                            {
                              if($row['name']==$pick2)
                              {
                              
                                continue;
                              
                              }

                              echo '<option value="'.$row['name'].'">'.$row['name'].'</option>';

                            }
                            ?>

                     
                      </select>
                    
                  
                </div>

                <p class="px-5 mb-2 col-sm-12 col-md-12 col-lg-12 bg-danger text-white" id="error1"></p>
                 


                <div class="form-group row input ml-1 mr-1">
                    <label class="col-sm-3 col-md-3 col-lg-3 col-xs-3 mt-2">Drop</label>
                    <select name="drop" id="drop" class="col-sm-9 col-md-9 col-xs-9 col-lg-9 input sel form-control-plaintext">
                        <option value="<?php echo $drop2?>"><?php echo $drop2?></option>
                        
                       
                        <?php

                              $user=new user();
                              $dbconnect=new Dbconnect();
                              $row1=$user->home($dbconnect->conn);
                              foreach($row1 as $key=>$row)
                              {
                               
                              
                                if($row['name']==$drop2)
                                {
                                
                                  continue;
                                
                                }
                                echo '<option value="'.$row['name'].'">'.$row['name'].'</option>';
                              }
                              ?>
                     
                      </select>
                  
                </div>
                <p class="px-5 mb-2 col-sm-12 col-md-12 col-lg-12 bg-danger text-white" id="error2"></p>
                

                <div class="form-group row input ml-1 mr-1">
                    <label class="col-sm-3 col-md-3 col-lg-3 col-xs-3 mt-2">Cab</label>
                    <select name="cars" class="col-sm-9 col-md-9 col-xs-9 col-lg-9 input sel form-control-plaintext" id="cars">
                        <option value="<?php echo $cars2?>"><?php echo $cars2?></option>
                       <?php if($cars2=="cedmicro") {?>
                        <!-- <option value="cedmicro">Cedmicro</option> -->
                        <option value="cedmini">Cedmini</option>
                        <option value="cedroyal">Cedroyal</option>
                        <option value="cedsuv">CedSuv</option>
                        <?php } elseif($cars2=="cedmini") {?>

                        <option value="cedmicro">Cedmicro</option>
                        <!-- <option value="cedmini">Cedmini</option>-->
                        <option value="cedroyal">Cedroyal</option> 
                        <option value="cedsuv">CedSuv</option>

                        <?php } elseif($cars2=="cedroyal") {?>

                          <option value="cedmicro">Cedmicro</option>
                        <option value="cedmini">Cedmini</option>
                        <!-- <option value="cedroyal">Cedroyal</option>  -->
                        <option value="cedsuv">CedSuv</option>

                        <?php } elseif($cars2=="cedsuv") {?>

                          <option value="cedmicro">Cedmicro</option>
                        <option value="cedmini">Cedmini</option>
                        <!-- <option value="cedroyal">Cedroyal</option>  -->
                        <option value="cedsuv">CedSuv</option>

                        <?php } ?>

                        
                      </select>
                  
                </div>
                <p class="px-5 mb-2 col-sm-12 col-md-12 col-lg-12 bg-danger text-white" id="error3"></p>
               


                <div class="form-group row input ml-1 mr-1">
                    <label class="col-sm-3 col-md-3 col-lg-3 col-xs-3 mt-2">Weight</label>
                    <input type="text" id="weight" placeholder="Enter Weight in kg" value="<?php echo $weight2?>" class="ibox col-sm-9 col-md-9 col-xs-9 col-lg-9 form-control-plaintext">
                  
                </div>

                <div class="col-sm-12 col-xs-12 col-lg-12 col-md-12">
                    <p class="px-5 mb-2 col-sm-12 col-md-12 col-lg-12 bg-danger text-white" id="error"></p>
                    <p class="text-center mb-2 bg-success text-white" id="res"></p>

                </div>


                <div class="form-group row ml-1 mr-1">
                    <input type="button" value="Calculate Fare" class="button2 col-sm-5 col-md-5 col-xs-5 col-lg-5 py-2 mb-3  form-control-plaintext" id="submit2">
                    <input type="submit" value="Book Ride"  class="button2 col-sm-5 col-md-5 col-xs-5 col-lg-5 py-2 mb-3 ml-4 form-control-plaintext" id="book2">
                    </div>
            
              </div>

                  <?php

                }
                else
                {
                  ?>

                  <div class="form-group row input ml-1 mr-1">
                  <label class="col-sm-3 col-md-3 col-lg-3 col-xs-3 mt-2">PickUp</label>
                  <select name="pick" id="pick" class="col-sm-9 col-md-9 col-xs-9 col-lg-9 input sel form-control-plaintext">
                      
                      <option value="0">Please choose pickup location</option>
                      
                      <?php

                              $user=new user();
                              $dbconnect=new Dbconnect();
                              $row1=$user->home($dbconnect->conn);
                              foreach($row1 as $key=>$row)
                              {

                                echo '<option value="'.$row['name'].'">'.$row['name'].'</option>';

                              }
                              ?>
                   
                    </select>
                  
                
              </div>

              <p class="px-5 mb-2 col-sm-12 col-md-12 col-lg-12 bg-danger text-white" id="error1"></p>
               


              <div class="form-group row input ml-1 mr-1">
                  <label class="col-sm-3 col-md-3 col-lg-3 col-xs-3 mt-2">Drop</label>
                  <select name="drop" id="drop" class="col-sm-9 col-md-9 col-xs-9 col-lg-9 input sel form-control-plaintext">
                      <option value="10">Please choose drop location</option>
                      
                     
                      <?php

                        $user=new user();
                        $dbconnect=new Dbconnect();
                        $row1=$user->home($dbconnect->conn);
                        foreach($row1 as $key=>$row)
                        {

                          echo '<option value="'.$row['name'].'">'.$row['name'].'</option>';

                        }
                        ?>
                   
                    </select>
                
              </div>
              <p class="px-5 mb-2 col-sm-12 col-md-12 col-lg-12 bg-danger text-white" id="error2"></p>
              

              <div class="form-group row input ml-1 mr-1">
                  <label class="col-sm-3 col-md-3 col-lg-3 col-xs-3 mt-2">Cab</label>
                  <select name="cars" class="col-sm-9 col-md-9 col-xs-9 col-lg-9 input sel form-control-plaintext" id="cars">
                      <option value="20">Please choose car type</option>
                      
                      <option value="cedmicro">Cedmicro</option>
                      <option value="cedmini">Cedmini</option>
                      <option value="cedroyal">Cedroyal</option>
                      <option value="cedsuv">CedSuv</option>
                      
                    </select>
                
              </div>
              <p class="px-5 mb-2 col-sm-12 col-md-12 col-lg-12 bg-danger text-white" id="error3"></p>
             


              <div class="form-group row input ml-1 mr-1">
                  <label class="col-sm-3 col-md-3 col-lg-3 col-xs-3 mt-2">Weight</label>
                  <input type="text" id="weight" placeholder="Enter Weight in kg"  class="ibox col-sm-9 col-md-9 col-xs-9 col-lg-9 form-control-plaintext">
                
              </div>

              <div class="col-sm-12 col-xs-12 col-lg-12 col-md-12">
                  <p class="px-5 mb-2 col-sm-12 col-md-12 col-lg-12 bg-danger text-white" id="error"></p>
                  <p class="text-center mb-2 bg-success text-white" id="res"></p>

              </div>


              <div class="form-group row ml-1 mr-1">
                  <input type="button" value="Calculate Fare" class="button2 col-sm-5 col-md-5 col-xs-5 col-lg-5 py-2 mb-3  form-control-plaintext" id="submit2">
                  <input type="submit" value="Book Ride"  class="button2 col-sm-5 col-md-5 col-xs-5 col-lg-5 py-2 mb-3 ml-4 form-control-plaintext" id="book2">
                  </div>
          
            </div>

         <?php

                }

                    ?>


            </form>

          

        </div>
        
        

    </section>


    <footer class="container-fluid">
        <div class="row">
        <div class="col-md-4 col-sm-4 col-xs-4 col-xl-4">        
          <i class="fab fa-facebook ml-5 py-5" style="font-size: 20px;"></i>
        <i class="fab fa-twitter-square ml-5 py-5" style="font-size: 20px;"></i>

        <i class="fab fa-instagram-square ml-5 py-5" style="font-size: 20px;"></i>
      </div>

      <div class="col-md-4 col-sm-4 col-xs-4 col-xl-4 ">        
        
        <p style="font-size: 30px;" class="text-center  mt-5 ml-0">Ced<span style="color: #CDDC39;">Cab</span></p>
       
      </div>
      <div class="col-md-4 col-sm-4 col-xs-4 col-xl-4">        
     
    </div>
    </div>
 
    

    </footer>
                <?php
                  }
                  else
                  {

                ?>

                    <script>
                    alert("Admin can't book cab");
                    window.location="Logout.php";
                    
                    </script>
                    <?php

                  }

                }

                else
                {
                  echo 'Please Login,first to continue <a href="login2.php">Click here to login</a>';
                }

                  ?>
                    
    <script src="cab.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
</body>
</html>