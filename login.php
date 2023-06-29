<?php
$conectar = mysql_connect('localhost','root','');
$banco    = mysql_select_db('portal');
?>
<HTML>
<HEAD>
<meta charset="UTF-8"> 
<TITLE>Área de Login dos Colunistas</TITLE>
</HEAD>
<BODY>
	<div id="login">
		<form name="form" method="post" action="login.php">
			<div id="textos">
				<h1>Login dos Colunistas </h1>
				Login:
				<input type="text" name="login" id="login" size=10>

				<br>
				<br>

				Senha:
				<input type="password" name="senha" id="senha" size=10>

				<br>
				<br>

				<input type="submit" name="conectar" id="conectar" value="Login">
			</div>
		</form>
	</div>
<style>
	form {
		width: 25%;
		height: 40%;
		background-color: black;
		text-align: center;
		font-family: Verdana, Geneva, Tahoma, sans-serif;
		margin: 0 auto;
		padding: 10px;
		margin-bottom: 10px;
		border-radius: 4px;
	}
	#textos {
		color: white;
	}
	h1 {
		text-align: center;
		color: white;
	}
	input,
	textarea,
	select {
		border: none;
		border-radius: 4px;
		box-shadow: 0 0 5px #000000;
	}
	#invalidez {
		text-align: center;
		font-family: Arial;
		font-size: 20px;

	}
</style>
<?php
	if (isset($_POST['conectar']))
	{
		$login   = $_POST['login'];
		$senha   = $_POST['senha'];
		$sql = "SELECT login, senha FROM colunistas
				WHERE login = '$login' AND senha = '$senha'";
		$resultado = mysql_query($sql);

		if (mysql_num_rows($resultado) <> 0)
		{  
			$colunistas = mysql_fetch_array($resultado);
			if ($colunistas["login"] !="")  {
				$_SESSION['login'] = $colunistas['login'];
				$_SESSION['senha'] = $colunistas['senha'];
				header("Location: menuCadastros.php");   }
		}
		else{
				echo "<div id='invalidez'>
				Usuário invalido! </div>";
			}
	}
?>	
</BODY>
</HTML>
