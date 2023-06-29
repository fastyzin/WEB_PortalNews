<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title> 
</head>
<body>
<?php 
$conectar = mysql_connect('localhost','root','');
$banco    = mysql_select_db('portal');

$codigo = $_POST['codigoM'];
$sql_materias = "SELECT * from materias WHERE materias.codigo = '$codigo'";
$pesquisa_tudo = mysql_query($sql_materias);
$res = mysql_fetch_array($pesquisa_tudo);





?>
</body>
</html>

