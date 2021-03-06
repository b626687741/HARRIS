<?php if(session_id() === ''){
    session_start();

} ?>
<!DOCTYPE html>
<html lang="en" style="position: relative; min-height: 100%;">
<head>
<title>Algonquin Social Media</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body style="padding-top: 50px; margin-bottom: 60px; background-color: rgba(240,240,240,0.51)">
    <nav class="navbar navbar-default navbar-fixed-top navbar-inverse">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" 
                       data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" style="padding: 10px" href="http://www.algonquincollege.com">
              <img src="/../Project/ProjectContents/AC.png"
                   style="max-width:100%; max-height:100%;"/>
          </a>    
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
               <li class="active"><a href="Index.php">Home </a></li>
               <li><a href="MyFriends.php">My Friends</a></li>
               <li><a href="MyAlbums.php">My Albums</a></li>
               <li><a href="MyPictures.php">My Pictures</a></li>
               <li><a href="UploadPictures.php">Upload Pictures</a></li>
               
               <?php if(isset($_SESSION["loginUser"])){
                   echo "<li><a href='logout.php'>Log Out</a></li>";
               }
               else{
                   echo "<li><a href='login.php'>Log In</a></li>";
               }
               ?>
           </ul>
        </div>
      </div>  
    </nav>

