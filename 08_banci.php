<html>
<head>
  <title>Conexiune PHP-MySQL</title>


</head>

<body style="font-family: Arial, Helvetica, sans-serif; color: Blue; background-color: silver;">


<h2 style="background-color: #F5DEB3;">Selectare din baza de date a bancilor</h2>

<?php

//conectare la baza de date

$db = mysqli_connect('localhost','root','root');

if (!$db)
{
	print "<h1>Nu s-a facut conectarea la baza de date</h1>";
}

$dbname = '1902_IAP_PROIECT';

$btest = mysqli_select_db($db, $dbname);

if (!$btest)
{
	print "<h1>Nu putem stabili conexiunea la baza de date</h1>";
}
//Selectarea din baza de date a bancilor

$sql_  = "SELECT distinct nume_banca, profil ";
$sql_ .= "FROM banca ";
$sql_ .= "ORDER BY nume_banca, profil ";

$result = mysqli_query($db, $sql_);

$msj_afisat = "";
$nr_randuri = 0;

if (!$result) {
	$msj_afisat .= "<br /><font color=red>MySQL No: ".mysqli_errno();
	$msj_afisat .= "<br />MySQL Eroare: ".mysqli_error();
	$msj_afisat .= "<br />Interogare SQL: ".$sql_;
	$msj_afisat .= "<br />randuri afectate: ".mysqli_affected_rows()."</font><br />";
} else {

	$msj_afisat  = "<h3>Banci aflate in baza de date si profilurile lor</h3>";

	$msj_afisat .= '<table border=1 style="color: black;">';
	$msj_afisat .= '<tr><th>Numele bancii</th><th>Profil</th></tr>'               	;

	$numresults = mysqli_num_rows($result);

	for ($i = 0; $i < $numresults; $i++)
	{
		if (!($i % 2) == 0)
		{
			 $msj_afisat .= "<tr style=\"background-color: #F5DEB3;\">";
		} else {
			 $msj_afisat .= "<tr style=\"background-color: white;\">";
		}

		$nr_randuri++;
//afisare in grid, 2 culori, construiesc tabel
		$rand = mysqli_fetch_array($result);

		$nume_banca  = $rand['nume_banca'];
		$profil  = $rand['profil'];

		$msj_afisat .= "<td>".$nume_banca."</td>";
		$msj_afisat .= "<td>".$profil."</td>";

		$msj_afisat .= "</tr>";

	}

	$msj_afisat .= "</table>";

}


?>


<hr size="4" style="background-color: #F5DEB3; color: #F5DEB3;">

<?php
	$msj_afisat .= "<br /><br /><b>Au fost extrase din baza de date: $nr_randuri </b><br /><br />";
	print $msj_afisat;
?>

</body>
</html>
