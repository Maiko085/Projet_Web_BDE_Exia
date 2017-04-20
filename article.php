<?php
$bdd = new PDO("mysql:host=localhost;dbname=projetweb;charset=utf8", "root", "");

if(isset($_GET['id']) AND !empty($_GET['id'])) {
	$get_id = htmlspecialchars($_GET['id']);

	$article = $bdd->prepare('SELECT * FROM articles WHERE id = ?');
	$article->execute(array($get_id));

	if($article->rowCount() == 1) {
		$article = $article->fetch();
		$id = $article['id'];
		$titre = $article['titre'];
		$contenu = $article['contenu'];

		$likes = $bdd->prepare('SELECT id FROM likes WHERE id_article = ?');
		$likes->execute(array($id));
		$likes = $likes->rowCount();

		$dislikes = $bdd->prepare('SELECT id FROM dislikes WHERE id_article = ?');
		$dislikes->execute(array($id));
		$dislikes = $dislikes->rowCount();

	} else {
		die('Cet article n\'existe pas !');
	}
} else {
	die('Erreur');
}
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="Style.css">
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="body.css" rel="stylesheet">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
	<title>Article</title>
</head>

<body>
<header>


<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
     <a href="Acceuille"><div class="logo"><img id="logo" src="ressources/logo.jpg" width="70" height="70"></div></a> 
    </div>
    <ul class="nav navbar-nav">
      <li> <a href="Vie Associative.html">Vie Associative</a> </li>
      <li> <a href="Phototech.html">Phototech</a> </li>
      <li> <a href="index.php">Actualité</a> </li>
      <li> <a href="Boutique.html">Boutique</a> </li>
      <li> <a href="Informations.html">Informations</a> </li>
    </ul>
    <form class="navbar-form navbar-right inline-form">
      <div class="form-group">
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
          <h1 align="center"><?= $titre ?></h1>
		  <p align="center"><?= $contenu ?></p>

        </div>
      </div>
    </div>
	

	<div class="container">
      <div class="row">
        <div class="col-sm-12">
          <br />
          <a href="action.php?t=1&id=<?= $id ?>">Likes</a> (<?= $likes ?>)
		  <br />
		  <a href="action.php?t=2&id=<?= $id ?>">Dislikes</a> (<?= $dislikes ?>)
		  <br />
          <a href="index.php">Retour</a>
        </div>
      </div>
    </div>

</body>
</html>