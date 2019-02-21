<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" href="credit.css" />
</head>

<body>

<div>
	<a href="04_login.html" border="0">
	</a>
</div>



<?php

}

$util=$_POST['util'];
$pass=$_POST['pass'];
$db = mysqli_connect('localhost','root','root');

if (!$db)
{
	print "<h1>Unable to Connect to MySQL</h1>";
}

$dbname = '1902_IAP_PROIECT';

$btest = mysqli_select_db($db, $dbname);

if (!$btest)
{
	print "<h1>Nu putem stabili conexiunea la baza de date</h1>";
}

$sql_= "SELECT nume, parola FROM autentificare"; 
$sql_ .= "WHERE nume = '".$util."' ";
$sql_ .= "and parola = '".$pass."' ";
#$rez = mysqli_query($db, $sql_);


?>

<div id="rezultat">
<?php>
$raspuns = '';
$rez=mysqli_query($db,$sql_); 
$rowcount=mysqli_num_rows($rez);
if ($rowcount != 0) {
    $raspuns = 'da';
	} else {
   $raspuns = 'nu';
      		}
if ( $raspuns = 'da')
{
	print "test";
	print "Sunteti autorizat";
} else {
	print "Nu sunteti autorizat";
}

?>

</div>

</body>
</html>