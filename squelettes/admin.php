<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Site internet administratif de la pourvoirie de la canne à pêche">
    <meta name="author" content="Flora Kasyan, Michel Van Hoye, Mathieu De Grandpré et Louis Cyr">
    <title>Pourvoirie La Canne &agrave; P&ecirc;che - Administration</title>
    <link rel="shortcut icon" href="./images/favicon.jpg">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <!-- NOS CSS -->
    <link href="./css/bootstrap.css" rel="stylesheet">
    <link href="../css/custom-theme/jquery-ui-1.10.3.custom.css" rel="stylesheet">
    <link href="./css/style.css" rel="stylesheet">

    <!-- NOS JS -->
    <script src="./js/vendor/jquery-1.10.1.min.js"></script>
    <script src="./js/jquery-1.9.1.js"></script>
    <script src="./js/jquery-ui-1.10.3.custom.js"></script>
    <script src="./js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    <script src="./js/vendor/bootstrap.min.js"></script>
    <script type="text/JavaScript" language="JavaScript" src="js/javascript.js"></script> 

  </head>

  <body>
    <div id="wrap">
      <!-- Début du menu de navigation -->
      <div class="navbar navbar-default navbar-fixed-top" role="navigation">
            <ul class="nav navbar-nav ">
              <li><a href="./index.html"><span class="titresMenu">SECTION ADMINISTRATION</span></a></li>
              <li><a href="./html/about.html"><span class="titresMenu">ÉLÉMENTS STATIQUES</span></a></li>
              <li><a href="./html/clients.html"><span class="titresMenu">CLIENTS</span></a></li>
              <li><a href="./html/reservations.html"><span class="titresMenu">RÉSERVATIONS</span></a></li>
              <li><a href="./html/chalet1.html"><span class="titresMenu">PRODUITS</span></a></li>
              <li><img src="../images/connexion.png" alt="cadenas" class="img-responsive hidden-xs">
              <a href="../index.html"><span class="titresLogin">DECONNEXION</span></a>
              </li>
            </ul>
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
    <script src="./js/jqueryStatique.js"></script>
  </body>
</html>
