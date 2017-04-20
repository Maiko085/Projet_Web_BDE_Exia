<!DOCTYPE html>
<html>
<meta charset="utf-8">
<body>


<a href="php/action.php?t=likeid=<?">Jaime</a>"
<br />
<a href="php/action.php?t=dislike&id=<?">Je naime pas</a> ()



$likes = $bdd->prepare('SELECT id FROM likes WHERE id_article = ?');
$likes->execute(array($id));
$likes = $likes->rowCount();

$dislikes = $bdd->prepare('SELECT id FROM dislikes WHERE id_article = ?');
$dislikes->execute(array($id));
$dislikes = $likes->rowCount();

<!DOCTYPE html>
<html>
<meta charset="utf-8">
<body>


<a href="php/action.php?t="1&id=<?">Jaime</a> (<?= $likes ?>)
<br />
<a href="php/action.php?t=2&id=<?">Je naime pas</a> (<?= $dislikes ?>)

