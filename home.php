<!DOCTYPE html>
<html lang="pt-br">
<meta charset="UTF-8">
<head>
    <title>Portal</title>
    <link rel="icon" type="image/png" href="icon.png">
</head>
<style>
        #cabecalho {
            width: 100%;
            height: 100px;
            background-color: black;
        }
        * {
            padding: 0;
            margin: 0;
            font-family: Arial;
        }
        #pesquisa {
            background-color:#d9dcd6;
            height: 400px;
            width: 23%;
            margin-left: 8px;
            border-radius: 6px;
            box-shadow: 0 0 7px #000000;
            display: inline-block;
        }
        .container {
			display: flex;
			flex-direction: row;
			justify-content: space-between;
		}
        #resultado{
            display: inline-flex;
        }
        input,
        textarea,
        select {
        margin-bottom: 16px;
        padding: 8px;
        border: none;
        border-radius: 4px;
        box-shadow: 0 0 5px #000000;
        }

        input[type="submit"] {
        background-color: #31cdff;
        color: white;
        cursor: pointer;
        transition: background-color 0.2s ease-in-out;
        }

        input[type="submit"]:hover {
        background-color: #000;
        }
        #select_regiao {
            font-size: 20px;
            padding-left: 7px;
            color: black;
            width: 15%;
        }
        #select_categorias {
            font-size: 20px;
            padding-left: 7px;
            color: black;
            width: 15%;
        }
        #select_colunista {
            font-size: 20px;
            padding-left: 7px;
            color: black;
            width: 18%;
        }
        .login {
            justify-content: space-evenly;
        }
</style>
<body>
    <div id="cabecalho"> 
        <center> <img src="logo.png" width="235" height="100"> 
        <img class="login" src="loginicon.png" width= "64px" height="48px"> </center>
    </div>
    <br>
<?php
    $conectar = mysql_connect('localhost','root','');
    $banco    = mysql_select_db('portal');
    $vazio = 0;

setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');

$sql_regiao      = "SELECT codigo, nome FROM regiao ";
$pesquisar_regiao = mysql_query($sql_regiao);

$sql_categorias       = "SELECT codigo, nome FROM categorias ";
$pesquisar_categorias = mysql_query($sql_categorias);

$sql_colunistas       = "SELECT codigo, nome FROM colunistas ";
$pesquisar_colunistas = mysql_query($sql_colunistas);

//---------------------------------------------------------------------------------------


if(!empty($_POST['pesq_regiao']))
{
    $regiao  = (empty($_POST['codregiao']))? 'null' : $_POST['codregiao'];

    if ($regiao <> '')
    {
     $sql_materias = "SELECT materias.fotochamada, materias.foto1, materias.data, materias.hora, materias.chamada, materias.resumo
                      FROM materias
                      WHERE materias.codregiao ='$regiao'
                      ORDER BY data desc limit 3";
     $seleciona_materias = mysql_query($sql_materias);
     $vazio = 1;
     }
}

if(!empty($_POST['pesq_categoria']))
{
    $categoria  = (empty($_POST['codcategoria']))? 'null' : $_POST['codcategoria'];

    if ($categoria <> '')
    {
     $sql_materias = "SELECT materias.fotochamada, materias.foto1, materias.data, materias.hora, materias.chamada, materias.resumo
                      FROM materias
                      WHERE materias.codcategoria ='$categoria'
                      ORDER BY data desc limit 3";
     $seleciona_materias = mysql_query($sql_materias);
     $vazio = 1;
     }
}

if(!empty($_POST['pesq_colunista']))
{
    $colunista  = (empty($_POST['codcolunista']))? 'null' : $_POST['codcolunista'];

    if ($colunista <> '')
    {
     $sql_materias = "SELECT materias.fotochamada, materias.foto1, materias.data, materias.hora, materias.chamada, materias.resumo
                      FROM materias
                      WHERE materias.codcolunista ='$colunista'
                      ORDER BY data desc limit 3";
     $seleciona_materias = mysql_query($sql_materias);
     $vazio = 1;
     }
}
?>
<div class="container">
<div id="pesquisa">

<form name="form_regiao" method="post" action="home.php">
<br>
<div id="select_regiao">    
Região 
<br>

<select name="codregiao" id="codregiao"> 

<option value=0 selected="selected">Selecione a região</option> 

<?php
if(mysql_num_rows($pesquisar_regiao) == 0)
{
   echo '<h1>Sua busca por regiao n�o retornou resultados ... </h1>';
}
else
{
  while($resultado = mysql_fetch_array($pesquisar_regiao))
  {
     echo '<option value="'.$resultado['codigo'].'">'.
                utf8_encode($resultado['nome']).'</option>';
  }
}
?>
</select>
<br>
<input type="submit" name="pesq_regiao" id="pesq_regiao" value="Pesquisar">
<br>
</div>
<div id="select_categorias">
Categorias <select name="codcategoria" id="codcategoria">
<option value=0 selected="selected">Selecione a categoria </option>
<?php
if(mysql_num_rows($pesquisar_categorias) == 0)
{
   echo '<h1>Sua busca por categorias n�o retornou resultados ... </h1>';
}
else
{
  while($resultado = mysql_fetch_array($pesquisar_categorias))
  {
     echo '<option value="'.$resultado['codigo'].'">'.
                utf8_encode($resultado['nome']).'</option>';
  }
}
?>
</select>
<input type="submit" name="pesq_categoria" id="pesq_categoria" value="Pesquisar">
<br>
</div>
<div id="select_colunista">
Colunista<select name="codcolunista" id="codcolunista">
<option value=0 selected="selected">Selecione o colunista </option>
<?php
if(mysql_num_rows($pesquisar_colunistas) == 0)
{
   echo '<h1>Sua busca por colunistas não retornou resultados ... </h1>';
}
else
{
  while($resultado = mysql_fetch_array($pesquisar_colunistas))
  {
     echo '<option value="'.$resultado['codigo'].'">'.
                utf8_encode($resultado['nome']).'</option>';
  }
}
?>
</select>
<input type="submit" name="pesq_colunista" id="pesq_colunista" value="Pesquisar">
</div>


</div>
</form>
<div id="resultados">
<!-------- Mostrar o resultado da pesquisa ----------->
<?php

    if ($vazio == 0)
    {
     $sql_materias = "select codigo, fotochamada, data, hora, chamada
                      from materias
                      ORDER BY data desc limit 3";

     $seleciona_materias = mysql_query($sql_materias);
     ?>
     <table border=0>
     <tr>
     <th><b>Noticias em Destaque: </b></th>
     </tr>
     <?php
     echo '<tr>';
 	 while($res = mysql_fetch_array($seleciona_materias))
			{
              echo '<td><a href="materiacompleta.php">'.utf8_encode('<img src="'.$res['fotochamada'].'"  height="180" width="250" />').'</a><br>';
              echo utf8_encode(strftime('%A - %d/%m/%Y', strtotime($res['data']))).' - '. $res['hora'].'<br>';
              echo utf8_encode($res['chamada']).'</td>';
			}
     echo '</tr>';
    }
    else
    {
  	 echo "<center><b>Noticias pesquisadas: </b>"."<br><br>";
  	 echo '<tr>';
     
 	 while($res = mysql_fetch_array($seleciona_materias))
			{
              echo '<td>'.utf8_encode('<img src="'.$res['fotochamada'].'"  height="180" width="250" />').'</a>';
              echo '<td> - </td><td>'.utf8_encode('<img src="'.$res['foto1'].'"  height="180" width="250" />').'</a><br>';
              echo utf8_encode(strftime('%A - %d/%m/%Y', strtotime($res['data']))).' - '. $res['hora'].'<br>';
              echo '<b>'.utf8_encode($res['chamada']).'</b><br>';
              echo utf8_encode($res['resumo']).'</td><br><br>';
              echo "<form action='materiacompleta.php?codigo = codigoM' method='POST'> 
              
                <input type='hidden' name='codigoM' id='codigoM' value='".$res['chamada']."'> 
                <input type='submit' name='ler_mais' id='ler_mais' value='Leia Mais'>
              </form>";
                                   
			}
     echo '</tr></center>';
    }
?>

</div>
</div>
    
</body>
</html>