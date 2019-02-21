<!DOCTYPE html>


<html>
<head>
	<title>Exercitiu 2</title>
	<link rel="stylesheet" href="credit.css" />
</head>

<body>

<div>
	<a href="02_Ex_2_HTML_x.html" border="0">
	</a>
</div>

<?php
// datele din aplicatie

$finantare = $_POST['finantare'];
$dobanda = $_POST['dobanda'];


//Do Validations

$msg = "";
$error_cnt = 0;

if (empty($finantare))
{
	$msg .= "<br><span class='errormsg'>Introduceti suma pentru finantare</span>";
	$error_cnt++;
} else {
	if (!is_numeric($finantare))
	{
		$msg .= "<br><span class='errormsg'>Suma finantata, '".$finantare."' nu este un numar </span>";
		$error_cnt++;
	}
}

if (empty($dobanda))
{
	$msg .= "<br><span class='errormsg'>Introduceti dobanda</span>";
	$error_cnt++;
} else {
	if (!is_numeric($dobanda))
	{
		$msg .= "<br><span class='errormsg'>Dobanda, '".$dobanda."' nu este un numar  </span>";
		$error_cnt++;
	}
}


//Do Calculations

$dobanda_calc = $dobanda / 100 ;

$credit_lunar= ($finantare * $dobanda_calc) / 12;

$credit_lunar = number_format($credit_lunar, 2);




?>


<div id="rezultat">


<?php

if ($error_cnt > 0)
{
	print "$msg";
} else {
	print "<p>Pentru o finantare de $".$finantare." cu dobanda de".$dobanda."% ...</p>";
	print "<p>Rata lunara va fi $".$credit_lunar."</p>";
}

?>

</div>

</body>
</html>
