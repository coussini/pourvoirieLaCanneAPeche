<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Site internet sur la pourvoirie de la canne à pêche">
    <meta name="author" content="Flora Kasyan, Michel Van Hoye, Mathieu De Grandpré et Louis Cyr">
    <title>La cannne &agrave; p&ecirc;che accueil</title>
    <link rel="shortcut icon" href="./images/favicon.jpg">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <!-- NOS CSS -->
    <link href="./css/bootstrap.css" rel="stylesheet">
    <link href="./css/custom-theme/jquery-ui-1.10.3.custom.css" rel="stylesheet">
    <link href="./css/style.css" rel="stylesheet">

    <!-- NOS JS -->
    <script src="./js/vendor/jquery-1.10.1.min.js"></script>
    <script src="./js/jquery-1.9.1.js"></script>
    <script src="./js/jquery-ui-1.10.3.custom.js"></script>
    <script src="./js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    <script src="./js/vendor/bootstrap.min.js"></script>
    <script src="./js/javascript.js" type="text/JavaScript" ></script> 

    <!-- TRAITEMENT SPÉCIFIQUE POUR LA RÉSERVATION -->    
    <?php
      if ($_GET['requete'] == 'reserver_html')
      {
    ?>
        <script src="js/calendrierReservation.js"></script>
        <script src="js/traitementCalendrierReservation.js"></script>
    <?php
      }    
    ?>

  </head>

  <body>
    <div id="wrap">
      <!-- Début du menu de navigation -->
      <div class="navbar navbar-default navbar-fixed-top">
        <div class="container">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a href="./index.html"><img src="./images/logo.png" alt="logo" class="img-responsive hidden-xs"></a>
          </div>
          <ul class="nav navbar-nav ">
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
    </div>
      
 <!---------------------------- -->
      <?php Controleur::gererRequetes(""); ?>
    <!---------------------------- -->
      <!-- PIED DE PAGE -->
    <div id="footer">
      <div class="container">
        <p class="text-muted">&copy; Pourvoirie La Canne à Pêche. Tous droits réservés.</p>
      </div>
    </div>
  </body>
</html>
