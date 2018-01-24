<!doctype html>
<html lang="en">
  <head>
    <title>Twitter</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <link rel="stylesheet" href="https://georgetimbrell.co.uk/MVC/styles.css">  
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="https://www.georgetimbrell.co.uk/MVC/">Twitter</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="?page=timeline">Your timeline</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="?page=yourtweets">Your tweets</a>
          </li>         
            <li class="nav-item">
            <a class="nav-link" href="?page=publicprofiles">Public profiles</a>
          </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <?php if($_SESSION['id']){ ?>
            
            <a class="btn btn-outline-success my-2 my-sm-0" href = "?function=logout">Logout</a>
            <?php } else{ ?>
          <button class="btn btn-outline-success my-2 my-sm-0" type="button" data-toggle="modal" data-target="#loginModal">Sign Up /Log in</button>
            <?php } ?>
        </form>
      </div>
    </nav>