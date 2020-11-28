<?php

if(isset($_POST['pick']) && isset($_POST['drop']) && isset($_POST['cars']) && isset($_POST['weight']))
{
   
$area=array("Charbagh"=>0,"Indranagar"=>10,"BBD"=>30,"Barabanki"=>60,"Faizabad"=>100,"Basti"=>150,"Gorakhpur"=>210);

$distance1=0;
$distance2=0;
$totaldistance;
$totalcost=0;


$pick=$_POST['pick'];
$drop=$_POST['drop'];
$cars=$_POST['cars'];


$weight=$_POST['weight'];
if($pick!="0" && $drop!="10")
{




foreach($area as $key=>$val)
{
    
    if($key==$pick)
    {
        $distance1=$val;
    }

    if($key==$drop)
    {
        $distance2=$val;
    }
  
}
$totaldistance=abs($distance2-$distance1);

if($cars=="cedmicro")
{
    if($totaldistance<=10)
    {
        $totalcost=50+($totaldistance*13.50);
    }
    elseif($totaldistance>=10 && $totaldistance<=60)
    {
        $totalcost=50+(10*13.50)+(($totaldistance-10)*12);
    }

    elseif($totaldistance>=60 && $totaldistance<=160)
    {
        $totalcost=50+(10*13.50)+(50*12)+(($totaldistance-60)*10.20);
    }

    elseif($totaldistance>=160)
    {
        $totalcost=50+(10*13.50)+(50*12)+(100*10.20)+(($totaldistance-160)*8.50);
    }
}

elseif($cars=="cedmini")
{

    if($totaldistance<=10)
    {
        $totalcost+=150+($totaldistance*14.50);
    }
    elseif($totaldistance>10 && $totaldistance<=60)
    {
        $totalcost+=150+(10*14.50)+(($totaldistance-10)*13);
    }

    elseif($totaldistance>60 && $totaldistance<=160)
    {
        $totalcost+=150+(10*14.50)+(50*13)+(($totaldistance-60)*11.20);
    }

    elseif($totaldistance>160)
    {
        $totalcost+=150+(10*14.50)+(50*13)+(100*11.20)+(($totaldistance-160)*9.50);
    }

    if($weight>=1 && $weight<=10)
    {
        $totalcost=$totalcost+50;
    }

    if($weight>10 && $weight<=20)
    {
        $totalcost=$totalcost+100;
    }
    if($weight>20)
    {
        $totalcost=$totalcost+200;
    }

}


elseif($cars=="cedroyal")
{

    if($totaldistance<=10)
    {
        $totalcost+=200+($totaldistance*15.50);
    }
    elseif($totaldistance>10 && $totaldistance<=60)
    {
        $totalcost+=200+(10*15.50)+(($totaldistance-10)*14);
    }

    elseif($totaldistance>60 && $totaldistance<=160)
    {
        $totalcost+=200+(10*15.50)+(50*14)+(($totaldistance-60)*12.20);
    }

    elseif($totaldistance>160)
    {
        $totalcost+=200+(10*15.50)+(50*14)+(100*12.20)+(($totaldistance-160)*10.50);
    }

    if($weight>=1 && $weight<=10)
    {
        $totalcost=$totalcost+50;
    }

    if($weight>10 && $weight<=20)
    {
        $totalcost=$totalcost+100;
    }
    if($weight>20)
    {
        $totalcost=$totalcost+200;
    }

}


elseif($cars=="cedsuv")
{

    if($totaldistance<=10)
    {
        $totalcost+=250+($totaldistance*16.50);
    }
    elseif($totaldistance>10 && $totaldistance<=60)
    {
        $totalcost+=250+(10*16.50)+(($totaldistance-10)*15);
    }

    elseif($totaldistance>60 && $totaldistance<=160)
    {
        $totalcost+=250+(10*16.50)+(50*15)+(($totaldistance-60)*13.20);
    }

    elseif($totaldistance>160)
    {
        $totalcost+=250+(10*16.50)+(50*15)+(100*13.20)+(($totaldistance-160)*11.50);
    }

    if($weight>=1 && $weight<=10)
    {
        $totalcost=$totalcost+100;
    }

    if($weight>10 && $weight<=20)
    {
        $totalcost=$totalcost+200;
    }
    if($weight>20)
    {
        $totalcost=$totalcost+400;
    }

}



echo"Total cost: ".($totalcost);
    }
}
else
{
    echo "<script>alert('Field cant be empty')</script>";
}

?>