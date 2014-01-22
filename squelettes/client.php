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
    <script src="./js/jquery.js"></script>
    <?php
      if ($_GET['requete'] == 'reserver_html')
      {
    ?>
        <!-- TRAITEMENT SPÉCIFIQUE POUR LA RÉSERVATION (AJAX et plus encore) -->    
        <script src="./js/calendrierReservation.js"></script>
        <script src="./js/traitementCalendrierReservation.js"></script>
    <?php
      }    
    ?>
  </head>
  <body>
    <!--[if lt IE 7]>
        <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
    <![endif]-->
    <div id="wrap">
      <div class="navbar navbar-default navbar-fixed-top">
        <div class="container container-menu">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a href="./index.php"><img src="./images/logo.png" alt="logo" class="img-responsive hidden-xs"></a>
          </div>
    <?php Controleur::gererMenuPrincipal(); ?>
        </div>
      </div>
    </div>
    <?php Controleur::gererRequetes(); ?>
     <footer>
        <p>&copy; Pourvoirie La Canne à Pêche. Tous droits réservés.</p>
    </footer>
  </body>
</html>
