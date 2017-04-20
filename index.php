<?php
$bdd = new PDO("mysql:host=localhost;dbname=projetweb;charset=utf8", "root", "");

$articles = $bdd->query('SELECT * FROM articles ORDER BY date_time_publication DESC');
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="Style.css">
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="body.css" rel="stylesheet">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
	<title>Accueil</title>
</head>	

<header>
<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
     <a href="Acceuille"><div class="logo"><img id="logo" src="ressources/logo.jpg" width="70" height="70"></div></a> 
    </div>
    <ul class="nav navbar-nav">
      <li> <a href="Vie Associative.html">Vie Associative</a> </li>
      <li> <a href="Phototech.html">Phototech</a> </li>
      <li class="active"> <a href="\Articles\index.php">Actualité</a> </li>
      <li> <a href="Boutique.html">Boutique</a> </li>
      <li> <a href="Informations.html">Informations</a> </li>
    </ul>
    <form class="navbar-form navbar-right inline-form">
      <div class="form-group">
      	<br />
        <p> <a href="Inscription" class="box">Inscription</a> /
        <a href="Connexion" class="box">Connexion</a> </p>
      </div>
    </form>
  </div>
</nav>
</header>

<body>

	<div class="container">
      <div class="row">
        <div class="col-sm-12">
          <h1>Bienvenue sur les activités à venir au CESI Lyon !</h1>
        </div>
      </div>
    </div>
	
	<div class="container">
      <div class="row">
        <div class="col-sm-12">
          <ul>
		<?php while($a = $articles->fetch()) { ?>
		<li><a href="article.php?id=<?= $a['id'] ?>"><?=$a['titre'] ?></a> | 
			<a href="redaction.php?edit=<?= $a['id'] ?>">Modifier</a> | 
			<a href="supprimer.php?id=<?= $a['id'] ?>">Supprimer</a></li>
		<?php } ?>
	<ul>
        </div>
      </div>
    </div>

	<div class="container">
	      <div class="row">
	        <div class="col-sm-12">
	          <a href="redaction.php">Nouveau</a>
	        </div>
	      </div>
	    </div>
	

</body>
</html>