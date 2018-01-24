<!DOCTYPE html>
<html lang="en">
  <head>




    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    
    <link id="css" rel="stylesheet" type="text/css" href="style.weather.css">

    <title>Weather App</title>

    <!-- Bootstrap -->

  </head>
  <body>
    <?php
      $weatherSite =  file_get_contents('https://www.weather-forecast.com/locations/'.$_GET['location'].'/forecasts/latest');
      $pattern = '!<span class="phrase">(.*?)</span>!i';
      if($_GET['location'] ==""){
        
        $forecast = "";
          
      } elseif  ($weatherSite)  {
        
        preg_match($pattern, $weatherSite, $match);
        //print_r($match);
        $forecast =  '<div class="card"><div id="forecast" class="card-body">
              '.$match[0].'
            </div></div>'; 
        
      } else  {
        
        $forecast='<div class="alert alert-danger">
                  <strong>Sorry!</strong> This location cannot be found, please try again.
                  </div>';
      }

    
    
    ?>
    
    
    <div id="wrapper" class="">
      <div class="row h-100 justify-content-center align-items-center">
        <div id ="main" class="container col-sm-6  justify-content-center">
        
          <h1>What is the weather?</h1>

          <form>
            <div class="form-group">
              <label for="location">Enter your location</label>
              <input type="text" class="form-control" id="location_input" placeholder="e.g london" name="location">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
          

              <?php echo $forecast  ?>

          
        </div> 
      </div>
    </div>
    
    
    
    
    
    


    
    
    
    
    
    
    
    
    
    
    
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>

  </body>
</html>