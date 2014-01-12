<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Flora Kasyan">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../docs-assets/ico/favicon.png">

    <title>La cannne &agrave; p&ecirc;che accueil</title>
	
	<!-- JS -->
	<script type="text/JavaScript" language="JavaScript" src="js/javascript.js"></script> 

    <!-- Bootstrap core CSS -->
    <link href="./css/bootstrap.css" rel="stylesheet">

    <!-- CSS -->
    <link href="./css/sticky-footer-navbar.css" rel="stylesheet">
	<link href="./css/stylesheetclient.css" rel="stylesheet">
	<link href="./css/stylesheet.css" rel="stylesheet">
	<link href="./css/bouton.css" rel="stylesheet">
	 
	 <script src="js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>

  </head>

  <body>
    <div id="wrap">
      <!-- Début du menu de navigation -->
      <div class="navbar navbar-default navbar-fixed-top" role="navigation">
            <ul class="nav navbar-nav ">
              <li><a href="./index.html"><img src="./images/logo.png" alt="logo" class="img-responsive hidden-xs"></a></li>
              <li class="active"><a href="./index.html"><img src="./images/accueil.png" alt="image accueil" class="img-responsive hidden-xs"><span class="titresMenu">ACCUEIL</span></a></li>
              <li><a href="./html/chalets.html"><img src="./images/chalets.png" alt="image chalets" class="img-responsive hidden-xs"><span class="titresMenu">NOS CHALETS</span></a></li>
              <li><a href="./html/infos.html"><img src="./images/info.png" alt="image infos" class="img-responsive hidden-xs"><span class="titresMenu">INFORMATIONS</span></a></li>
              <li><a href="./html/contact.html"><img src="./images/contact.png" alt="image contact" class="img-responsive hidden-xs"><span class="titresMenu">CONTACT</span></a></li>
              <li><img src="./images/connexion.png" alt="cadenas" class="img-responsive hidden-xs">
                  <a href="./html/profil.html"><span class="titresLogin">PROFIL</span>
                  <a href="./html/login.html"><span class="titresLogin">CONNEXION</span></a>
                  <a href="#"><span class="titresLogin">DÉCONNEXION</span></a>
              </li>
            </ul>
        </div>
      </div>
      
 <!---------------------------- -->
      <?php Controleur::gererRequetes(); ?>
    <!---------------------------- -->
      <!-- PIED DE PAGE -->
    <div id="footer">
      <div class="container">
        <p class="text-muted">&copy; Pourvoirie La Canne à Pêche. Tous droits réservés.</p>
      </div>
    </div>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <script src="./js/vendor/jquery-1.10.1.min.js"></script>
    <script src="./js/vendor/bootstrap.min.js"></script>
  </body>
</html>
