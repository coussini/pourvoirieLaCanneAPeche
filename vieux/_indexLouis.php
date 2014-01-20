<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>RÉSERVATIONS</title>
    <link rel="shortcut icon" href="./images/favicon.jpg">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <!-- NOS CSS -->
  </head>
  <body>
    <!--[if lt IE 7]>
        <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
    <![endif]-->

    <form method="GET" action="indexReservations.php">
      ID_Utilisateur : <input type="text" name="id_utilisateur"/><br/>
      ID_produit : <input type="text" name="id_produit"/><br/>
      <legend><b>Client ou Admin</b></legend>
      <select name="requetePage" size="1">
        <option value="client" >Page des clients</option>
        <option value="admin" >Page administration</option>
      </select>
      <legend><b>Afficher page</b></legend>
      <select name="requete" size="1">
        <option value="reserver_html" >Réserver</option>
        <option value="historique_html" >Historique du client</option>
        <option value="reservations_html" >Historique de tout les clients</option>
      </select>
      <input type="submit" value="AFFICHER"/>
    </form>        
  </body>
</html>