<?php
echo '<!DOCTYPE html>
	<html>
	<head>
	<title>Strona dla newsów</title>
	<meta charset="utf-8">
	</head>
	<body>
	<h1>LICEUM OGÓLNOKSZTAŁCĄCE<br>
	im. T. Kościuszki<br>
	w Sobolewie</h1>
	<a href="index.php?akcja=nowy">Nowa kategoria</a>
	';
include("polaczenie.php");
include("news_kategorie.php");

echo'
	</body>
	</html>';

?>