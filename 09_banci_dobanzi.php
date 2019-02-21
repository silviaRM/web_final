<html>
<head>
  <title>Selectare de oferte</title>
  <link rel="stylesheet" href="06_credit.css" type="text/css">

</head>

<body style="font-family: Arial, Helvetica, sans-serif; color: Blue; background-color: silver;">

<form id="myform" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" >


<h2 style="background-color: #F5DEB3;">Alegeti banca si vizualizati ofertele</h2>

<p>Introduceti numele bancii pe care doriti sa o afisati sau nu introduceti nicio valoare pentru a afisa toate bancile:
<input type='text' name='nume_banca' size='20' />
</p>

<?php

if (isset($_POST['nume_banca']))
{
	$nume_banca = $_POST['nume_banca'];

	if (empty($nume_banca))
	{
		$nume_banca = 'X';
	}
} else {
	$nume_banca = 'X';
}



//conectare la baza de date

$db = mysqli_connect('localhost','root','root');

if (!$db)
{
	print "<h1>Nu s-a pututface conectarea</h1>";
}

$dbname = '1902_IAP_PROIECT';

$btest = mysqli_select_db($db, $dbname);

if (!$btest)
{
	print "<h1>Nu putem stabili conexiunea la baza de date</h1>";
}


// selectare rezultate

$sql_  = "SELECT distinct nume_banca, val_dobanda, profil ";
$sql_ .= "FROM banca join dobanda using(id_dobanda) ";

if ($nume_banca != 'X')
{
	$sql_ .= "WHERE nume_banca = '".$nume_banca."' ";
}

$sql_ .= "ORDER BY nume_banca asc, val_dobanda asc ";

$result = mysqli_query($db, $sql_);

$msj_afisat = "";
$nr_randuri = 0;

if (!$result) {
	$msj_afisat .= "<br /><font color=red>MySQL No: ".mysqli_errno();
	$msj_afisat .= "<br />MySQL Eroare: ".mysqli_error();
	$msj_afisat .= "<br />Interogare SQL: ".$sql_;
	$msj_afisat .= "<br />randuri afectate: ".mysqli_affected_rows()."</font><br />";
} else {

	if ($nume_banca == 'X')
	{
		$msj_afisat  = "<h3>Se vor afisa toate bancile</h3>";
	} else {
		$msj_afisat  = "<h3>Dobanzi pentru ".$nume_banca."</h3>";
	}


	$msj_afisat .= '<table border=1 style="color: black;">';
	$msj_afisat .= '<tr><th>Banca</th><th>Profil</th><th>Dobanda</th></tr>';

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

		$row = mysqli_fetch_array($result);

		$nume_banca  = $row['nume_banca'];
		$profil = $row['profil'];
		$dobanda = $row['val_dobanda'];

		$msj_afisat .= "<td>".$nume_banca."</td>";
		$msj_afisat .= "<td>".$profil."</td>";
		$msj_afisat .= "<td>".$dobanda."</td>";

		$msj_afisat .= "</tr>";

	}

	$msj_afisat .= "</table>";

}


?>

<p><input type="submit" value="Afisati" /></p>

<hr size="4" style="background-color: #F5DEB3; color: #F5DEB3;" />

<?php
	$msj_afisat .= "<br /><br /><b>Au fost extrase din baza de date:: $nr_randuri </b><br /><br />";
	print $msj_afisat;
?>


</body>
</html>
