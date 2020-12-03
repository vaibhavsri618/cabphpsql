

<?php


if(isset($_SESSION['userdata']['userid']))
{

?>

<!doctype html>
<html lang="en">
  <head>
    <title>CedCab</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://kit.fontawesome.com/4b2ee26aaa.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="style.css">

    
  </head>

  

<header style="background-color:lightgray">
      <nav  class="navbar navbar-expand-lg">
      <h2>Ced<span style="color: #CDDC39;">Cab</span></h2>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span><i class="fas fa-bars logo text-dark"></i></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav ml-auto">

              <?php
              
                if (isset($_SESSION['userdata'])) {
                    echo "<h1 style='margin:10px 150px 10px 0px'>Welcome 
                        ".$_SESSION["userdata"]["username"]."</h1>";
                }
                ?>
                
                  <li class="nav-item rbtn">
                      <a class="btn" href="Logout.php">Logout</a>
                  </li>
              </ul>
          </div>
      </nav>
  </header>


  <?php

              }
?>