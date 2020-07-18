<?php

    $population="";
    $error="";
    if (array_key_exists('city', $_GET)){
        
        $city=str_replace(' ','',$_GET['city']);
        $file_headers = @get_headers("https://www.weather-forecast.com/locations/".$city."/forecasts/latest");
        if($file_headers[0] == 'HTTP/1.1 404 Not Found') 
        {
            $error="This city couldn't able be Find";
        }
        else
        {
            $forecastPage=file_get_contents("https://www.weather-forecast.com/locations/".$city."/forecasts/latest");
            $pageArray=explode("has a population of",$forecastPage);
            if (sizeof($pageArray) >1){
                 $secondPageArray=explode(". Local time in",$pageArray[1]);
                if (sizeof($pageArray)>1){
                    $population=$secondPageArray[0];
                }
                else{
                    $error="This city couldn't able be Find";
                }
            }
            else{
                $error="This city couldn't able be Find";
            }
                
        }
    }
    
    
?>
<!doctype html>
<html lang="en">
    
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

        <title>Project(php)</title>
        
        <style type="text/css">
        
        html{ 
            background: url(photo.jpg) no-repeat center center fixed; 
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
            opacity:0.7;
        }
        body{
            background:none;
        }
        #content{
            position:fixed;
            top:50%;
            left:50%;
            width:800px;
            height:200px;
            margin-left:-350px;
            margin-top:-55px;
        }
        #weather{
            text-align:center;
            font-size:60px;
            font-family:Arial;
            color:#1a1a00;
            font-width:1200;
        }
        small{
            margin-left:280px;
            font-size:20px;
            font-family:Sans-serif;
            font-width:600;
            color:white;
        }
        button{
            margin-left:340px;
        }
        input{
            margin:10px 0px;
        }
        #population{
            margin:50px 0px;
        }
        
        
        </style>
        
    </head>
  
    <body>
        <div id="content">
            
            <div id="weather">WHAT'S THE POPULATION</div>
            <small>Enter Your City Name</small>
            
            <form>
                <div class="form-group">
                    <input type="text" class="form-control" id="location" name="city" placeholder="Eg. Delhi,India" value="<?php
                        if(array_key_exists('city', $_GET)){
                        echo $_GET['city'];}?>">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            
            <div id="population"><?php
                    
                    if ($population){
                        echo '<div class="alert alert-success" role="alert">Population of <strong>'.$_GET['city'].'</strong> is <strong>'
                    .$population.'</strong>(approx.).</div>';
                    }
                    
                    else if($error){
                        echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';
                    }
            ?></div>
        </div>     
            
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
          
    </body>

</html>