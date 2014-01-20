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
    <link href="./css/custom-theme/jquery-ui-1.10.3.custom.css" rel="stylesheet">
    <link href="./css/style.css" rel="stylesheet">

    <!-- NOS JS -->
    <script src="./js/vendor/jquery-1.10.1.min.js"></script>
    <script src="./js/jquery-1.9.1.js"></script>
    <script src="./js/jquery-ui-1.10.3.custom.js"></script>
    <script src="./js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    <script src="./js/vendor/bootstrap.min.js"></script>jquery.js
    <script src="./js/jquery.js"></script>

</script>

  </head>
  <body>
    <div id="wrap">
      <div class="navbar navbar-default navbar-fixed-top">
        <div class="container">
          <ul class="nav navbar-nav ">
            <li class="active"><span class="titresMenuAdmin">SECTION ADMINISTRATION</span></li>
            <li><a href="./admin.php?requete=elements_statique_html"><span class="titresMenuAdmin">ÉLÉMENTS STATIQUES</span></a></li>
            <li><a href="./admin.php?requete=elements_statique_html"><span class="titresMenuAdmin">CLIENTS</span></a></li>
            <li><a href="./admin.php?requete=reservations_html"><span class="titresMenuAdmin">RÉSERVATIONS</span></a></li>
            <li><img src="./images/connexion.png" alt="cadenas" class="img-responsive hidden-xs">
            <a href="./html/profil.html"><span class="titresLogin">PRODUITS</span>
            <a href="#"><span class="titresLogin">DÉCONNEXION</span></a>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <?php Controleur::gererRequetes("",""); ?>    
    <footer>
      <p>&copy; Pourvoirie La Canne à Pêche. Tous droits réservés.</p>
    </footer>

  </body>
</html>
