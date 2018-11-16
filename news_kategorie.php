<?php
$akcja = '';
if(isset($_GET["akcja"])){
	$akcja = $_GET["akcja"];
}
if(isset($_GET["id"])){
	$id = $_GET["id"];
}

if($akcja=="nowy"){
	//wyświetla formularz nowej kategorii
	echo'
		<form enctype="multipart/form-data" 
			action="index.php?akcja=dodaj" method="post">		
		<label>Nazwa kategorii newsów:
		<input name="nazwa" type="text" size="30">
		</label><br>
		<label>Kolejność:
		<input name="kolejnosc" type="text" size="3">
		</label><br>
		<input name="obraz" type="file"><br><br>
		<input type="submit" value="Dodaj kategorię">		
		</form>
		';
} elseif($akcja=="dodaj"){
	//zapis nowego rekordu do tabeli
	$rok = date("Y");
	$lokalizacja = "./zasoby/".$rok."/news_kategorie/news_kategoria.jpg";
	if ($_FILES['obraz']['type'] != 'image/jpeg'){
		echo'To nie jest obraz .jpg!';
	} else {
		if(is_uploaded_file($_FILES['obraz']['tmp_name'])){
			move_uploaded_file($_FILES['obraz']['tmp_name'], $lokalizacja);
		$sql = "INSERT INTO `kategorie_news`(`katnews_id`, `katnews_nazwa`, `katnews_kolejnosc`, `katnews_obraz`) 
			     VALUES (0,'".$_POST['nazwa']."',".
							$_POST['kolejnosc'].",'".
							$lokalizacja."')";
		$query = mysqli_query($link,$sql);
		if(!$query){
			echo "Wystąpił błąd przy dodawaniu kategorii ".$_POST['nazwa'];
		}	else{
			echo "Dodano kategorię ".$_POST['nazwa'];
		}	
		}
	}	
	
} elseif($akcja=="edycja"){
	//formularz z danymi do edycji
	
} elseif($akcja=="edytuj"){
	//aktualizacja rekordu w tabeli
	
} elseif($akcja=="usun"){
	//skasowanie rekordu w tabeli
	$sql="DELETE FROM `kategorie_news` WHERE `katnews_id`=".$_GET['id'];
	$query = mysqli_query($link, $sql);
	if(!$query){
		echo "Wystąpił błąd przy usuwaniu kategorii ".$_GET['id'];
	}	else{
		echo "Usunięto kategorię ".$_GET['id'];
	}	
	
} else {
	//wyświetlenie listy kategorii
	echo'
		<table align = "center" border ="1">
		<tr>
		<td align = "center"> Nazwa kategorii</td>
		<td align = "center"> Kolejnosc</td>
		<td align = "center">		Obraz</td>
		</tr>
		';
		$sql = "SELECT * FROM `kategorie_news` WHERE 1 ORDER BY 'katnews_kolejnosc' ASC";
		$rekordy = mysqli_query($link, $sql);
		while($rekord = mysqli_fetch_array($rekordy)) {
			echo'
				<tr>
				<td align = "center">', $rekord["katnews_nazwa"],'</td>
				<td align = "center">', $rekord["katnews_kolejnosc"],'</td>
				<td align = "center">', $rekord["katnews_obraz"],'</td>
				<td align = "center"><a href = "index.php?akcja=edycja&id=',$rekord["katnews_id"],'">Edycja</a>
				<a href = "index.php?akcja=usun&id=',$rekord["katnews_id"],'">Usuń</a>
				</td>
				</tr>';
		}
	echo'		
		</table>
		';
}
?>