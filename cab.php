<?php



require 'user.php';
$book=array();

if(isset($_POST['pick']) && isset($_POST['drop']) && isset($_POST['cars']) && isset($_POST['weight']))
{
   

$distance1=0;
$distance2=0;
$totaldistance;
$totalcost=0;


$pick=$_POST['pick'];
$drop=$_POST['drop'];
$cars=$_POST['cars'];


$weight=$_POST['weight'];

$_SESSION['book']=array('from'=>$pick,'to'=>$drop,'cars'=>$cars,'weight'=>$weight);


if($pick!="0" && $drop!="10")
{
   

    $date=date("Y-m-d");

$user=new user();
$dbcon=new Dbconnect();
$show=$user->book($pick,$drop,$cars,$weight,$date,$dbcon->conn);

}
else
{
    echo "<script>alert('Field cant be empty')</script>";
}
}

?>