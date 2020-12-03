$(document).ready(function(){
    $("#book2").hide();
    $("#book").hide();
    $cars=$("#cars").val();
    if($cars=="cedmicro")
    {
   
    $("#weight").hide();
    $("#weight").val("");
   
    }
    $("#cars").change(function(){

        $cars=$("#cars").val();
        

        console.log($cars);

        $("#weight").attr("disabled",$cars=="cedmicro");
        $("#error").html("Extra Luggage facility is not available in cedmicro");

        if($cars=="cedmicro")
        {
        $("#error").show();
        $("#weight").hide();
        $("#weight").val("");
       
        }
        else
        $("#error").hide();
        $("#weight").show();

    
    
    });


    $("#weight").bind("keypress", function (e) {
        var keyCode = e.which ? e.which : e.keyCode
             
        if (!(keyCode >= 48 && keyCode <= 57)) {
           return false;
        }
    });

    $("#mobile").bind("keypress", function (e) {
        var keyCode = e.which ? e.which : e.keyCode
             
        if (!(keyCode >= 48 && keyCode <= 57)) {
           return false;
        }
    });

    $("#nam").bind("keypress", function (e) {
        var keyCode = e.which ? e.which : e.keyCode
             
        if ((keyCode >= 48 && keyCode <= 57)) {
           return false;
        }
    });

    $("#distance").bind("keypress", function (e) {
        var keyCode = e.which ? e.which : e.keyCode
             
        if (!(keyCode >= 48 && keyCode <= 57)) {
           return false;
        }
    });

    $("#mobile").bind("keypress", function (e) {
        var keyCode = e.which ? e.which : e.keyCode
             
        if (!(keyCode >= 48 && keyCode <= 57)) {
           return false;
        }
    });

    $("#nam").bind("keypress", function (e) {
        var keyCode = e.which ? e.which : e.keyCode
             
        if ((keyCode==32)) {
           return false;
        }
    });

    $("#drop").bind("keypress", function (e) {
        var keyCode = e.which ? e.which : e.keyCode
             
        if ((keyCode==32)) {
           return false;
        }
    });



    $("#submit").click(function(a){

        a.preventDefault();

        var pick=$("#pick").val();
        var drop=$("#drop").val(); 
        var cars=$("#cars").val(); 
        var weight=$("#weight").val();
        console.log(pick);




        console.log(drop);
      
        

       
        $("#error1").html("Please Choose any pickup location");
        $("#error2").html("Please Choose any Drop location");
        $("#error3").html("Please Choose any one car category");
      
      
        
        


        if(pick=="0")
        {
            
            $("#error1").show();
            $("#res").hide();
           
         
           
        }
        else
        {
        $("#error1").hide();
        $("#res").show();
       
       
       

        }

        if(drop=="10")
        {
           
            $("#error2").show();
            $("#res").hide();
           
            
    
        }
        else
        {
        $("#error2").hide();
        $("#res").show();
      
       

       
        }

        if(cars=="20")
        {
           
            $("#error3").show();
            $("#res").hide();
          
           
        }
        else
        {
            
        $("#error3").hide();
        $("#res").show();
      
       

       
        }
       

        if(drop==pick)
        {
            $("#error").html("Drop and pickup can't be same");
            $("#error").show();
            $("#res").hide();
           
          
           
           
        }
        else
        {
          
            $("#error").hide();
            $("#res").show();
            
          

       
            
        }

        if(drop!=pick && drop!="10" && pick!="0" && cars!="20")
        {

           
        
        console.log(cars);
        console.log(weight);
        



    $.ajax({
        type: 'post',
        url: 'cab.php',
        data:{
            pick:pick,
            drop:drop,
            cars:cars,
            weight:weight

        },
        success: function (answer) {
           
          $("#res").html(answer);

          $("#book").show();
          $("#submit").hide();

          $("#drop").change(function(){

            $("#submit").show();
            $("#book").hide();
            });

            $("#pick").change(function(){

                $("#submit").show();
                $("#book").hide();
                });

                $("#cars").change(function(){

                    $("#submit").show();
                    $("#book").hide();
                    });

                    $("#weight").keyup(function(){

                        $("#submit").show();
                        $("#book").hide();
                        });
            
        
    


          
        }
      });
    }

    });

    $("#book").click(function(){

        alert("Please LOgin first");
        window.location.href= "login2.php";
        return false;

    });





    $("#book2").click(function(a){

        $(this).hide();
        $("#submit2").hide();

       $("#submit2").click(function(){

        $("#book2").show();


       });
        a.preventDefault();

       

        

        var pick=$("#pick").val();
        var drop=$("#drop").val(); 
        var cars=$("#cars").val(); 
        var weight=$("#weight").val();
        console.log(pick);

        console.log(drop);
        console.log(cars);

        if(pick=="0" || drop=="10" || cars=="20" || drop==pick)
        {
            alert("field cant be empty / Location can't be same")
        }
        else
        {
            $.ajax({
                type: 'post',
                url: 'cab.php',
                data:{
                    pick:pick,
                    drop:drop,
                    cars:cars,
                    weight:weight
        
                },
                success: function (answer) {
                   
                  $("#res").html(answer);
                  
                }
              });
        
        }

    });



    $("#submit2").click(function(a){

   

        
        a.preventDefault();

        var pick=$("#pick").val();
        var drop=$("#drop").val(); 
        var cars=$("#cars").val(); 
        var weight=$("#weight").val();
        console.log(pick);

    



        console.log(drop);
        

       
        $("#error1").html("Please Choose any pickup location");
        $("#error2").html("Please Choose any Drop location");
        $("#error3").html("Please Choose any one car category");
      
      
        
        


        if(pick=="0")
        {
            
            $("#error1").show();
            $("#res").hide();
           
        }
        else
        {
        $("#error1").hide();
        $("#res").show();
        }

        if(drop=="10")
        {
           
            $("#error2").show();
            $("#res").hide();
        }
        else
        {
        $("#error2").hide();
        $("#res").show();
        }

        if(cars=="20")
        {
           
            $("#error3").show();
            $("#res").hide();
        }
        else
        {
        $("#error3").hide();
        $("#res").show();
        }
       

        if(drop==pick)
        {
            $("#error").html("Drop and pickup can't be same");
            $("#error").show();
            $("#res").hide();
        }
        else
        {
            $("#error").hide();
            $("#res").show();
            
        }

        
        console.log(cars);
        console.log(weight);


        if(drop!=pick && drop!="10" && pick!="0" && cars!="20")
        {
    $.ajax({
        type: 'post',
        url: 'cabcalculate.php',
        data:{
            pick:pick,
            drop:drop,
            cars:cars,
            weight:weight

        },
        success: function (answer) {
             
          $("#res").html(answer);

          $(this).hide();
        $("#book2").show();
        }
      });
    }

    });



});