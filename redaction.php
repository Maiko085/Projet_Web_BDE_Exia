<?php
$bdd = new PDO("mysql:host=localhost;dbname=projetweb;charset=utf8", "root", "");

$mode_edition = 0;

if(isset($_GET['edit']) AND !empty($_GET['edit'])) {
	$mode_edition = 1;
	$edit_id = htmlspecialchars($_GET['edit']);
	$edit_article = $bdd->prepare('SELECT * FROM articles WHERE id = ?');
	$edit_article->execute(array($edit_id));

	if($edit_article->rowCount() == 1) {

		$edit_article = $edit_article->fetch();
	} else {
		die('Erreur : l\'article n\'existe pas...');
	}
}

if(isset($_POST['article_titre'], $_POST['article_contenu'])) {
	if(!empty($_POST['article_titre']) AND !empty($_POST['article_contenu'])) {
			$article_titre = htmlspecialchars($_POST['article_titre']);
			$article_contenu = htmlspecialchars($_POST['article_contenu']);

			if($mode_edition == 0) {
				$ins = $bdd->prepare('INSERT INTO articles (titre, contenu, date_time_publication) VALUES (?, ?, NOW())');
				$ins->execute(array($article_titre, $article_contenu));
				header('Location: http://127.0.0.1/index.php');
				$message = 'Votre article à bien été posté';

			}else {
				$update = $bdd->prepare('UPDATE articles SET titre = ?, contenu = ?, date_time_publication = NOW() WHERE id = ?');
				$update->execute(array($article_titre, $article_contenu, $edit_id));
				header('Location: http://127.0.0.1/article.php?id='.$edit_id);
							$message = 'Votre article à bien été mis a jour';
			}

	} else {
		$erreur = 'Veuillez remplir tous les champs';
	}
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
        <input type="search" class="input-sm form-control" placeholder="Recherche">
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
          <h1>Proposez la prochaine activité du BDE</h1>
        </div>
      </div>
    </div>

	<div class="container">
      <div class="row">
        <div class="col-sm-12">
          <form method="POST">
		<input type="text" name="article_titre" placeholder="Titre"<?php if($mode_edition == 1) { ?> value="<?= $edit_article['titre'] ?>"<?php } ?>/><br />
		<textarea name="article_contenu" placeholder="Contenu de l'article"><?php if($mode_edition == 1) { ?><?= $edit_article['contenu'] ?><?php } ?></textarea><br />
		<input type="submit" value="Envoyer l'article" />
	</form>
	<br />
	<?php if(isset($message)) { echo $message; } ?>
        </div>
      </div>
    </div>

	

</body>
</html>