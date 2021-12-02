
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="asset/css/style.css">
</head>

<body>
<?php
if(isset($_SESSION['login'])){
    echo"
    <body>
    <header>
    <div class='header'>
    <a href='index.php'><h1  class='logo'> Retro discover</h1></a>
          <div class='toggle'>
              <nav role=navigation>
                   <a href='profil.php' href>Mon profil</a>
                   <a href='deconnexion.php'>deconnexion</a>
                   <a href='livre-or.php'>livre or</a>
             </nav>
        </div>
    </div>
    </header>";
   }
   else{
  echo"<body>
  <header>
        <div class='header'>
        <a href='index.php'><h1  class='logo'> Retro discover</h1></a>
                <div class='toggle'>
                    <nav role='navigation'>
                        <a href='connexion.php' href>connexion</a>
                        <a href='inscription.php'>inscription</a>
                        <a href='livre-or.php'>livre or</a>
                    </nav>
             </div>
        </div>
    </header>";
   }
   ?>