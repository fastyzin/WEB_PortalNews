<?php
    $conectar = mysql_connect('localhost','root','');
    $banco    = mysql_select_db('portal');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Colunistas </title>
    <link rel="icon" type="image/png" href="icon.png">
</head>
<body>
<div id="cabecalho"> 
    <center> <img src="logo.png" width="235" height="100"> </center>
</div><br>
<h1><center> Cadastro dos colunistas</center></h1><br>
<form name="form" method="post" action="CadastroColunistas.php">
    Codigo: <input type="text" name="codigo" id="codigo" size="20">
    <br>
    <br>
    Nome: <input type="text" name="nome" id="nome" size="20">
    <br>
    <br>
    Email: <input type="text" name="email" id="nome" size="20">
    <br>
    <br>
    Login: <input type="text" name="login" id="login" size="20">
    <br>
    <br>

    Senha: <input type="text" name="senha" id="senha" size="20">
    <br>
    <br>
    <input type="submit" name="gravar" id="gravar" value="Gravar">
    <input type="submit" name="alterar" id="alterar" value="Alterar">
    <input type="submit" name="excluir" id="excluir" value="Excluir">
    <input type="submit" name="pesquisar" id="pesquisar" value="Pesquisar">
</form>
<style>
form {
  display: flex;
  flex-direction: column;
  max-width: 500px;
  margin: 0 auto;
  padding: 10px;
  margin-bottom: 10px;
  box-shadow: 6px 5px 50px black;
  background-color: #fff;
  border-radius: 4px;
}

label {
  margin-bottom: 15px;
  font-weight: bold;
}
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
  color: black;
  cursor: pointer;
  transition: background-color 0.2s ease-in-out;
}

input[type="submit"]:hover {
  background-color: #000;
  color:white;
}

input:invalid {
  border-color: red;
}

input:valid {
  border-color: green;
}

</style>

<?php

    if (isset($_POST['gravar']))
    {
        $codigo = $_POST['codigo'];
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $login = $_POST['login'];
        $senha = $_POST['senha'];
        $sql = "insert into colunistas (codigo,nome,email,login,senha)
                values ('$codigo', '$nome', '$email', '$login', '$senha')";

        $resultado = mysql_query($sql);
        
        if ($resultado){
            echo "<center>
            <font-family: Arial;>
            <font-size: 4;> 
                Dados enviados com sucesso.
            </font>
            </center> ";
        }
        else {
            echo "<center> 
            <font-family: Arial;>
            <font-size: 4;>
                Erro ao enviar dados
            </font> 
            </center>";
        }
    }

    if (isset($_POST['alterar']))
    {
        $codigo = $_POST['codigo'];
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $login = $_POST['login'];


        $sql = "update colunistas set nome = '$nome', email = '$email', login = '$login'
                where codigo = '$codigo'";

        $resultado = mysql_query($sql);
        
        if($resultado) 
        {
            echo "Dados alterados com sucesso meu consagrado. ";
        }
        else 
        {
            echo "Erro ao alterar os dados. ";
        }
    }

    if (isset($_POST['excluir']))
    {
        $codigo = $_POST['codigo'];
        $nome = $_POST['nome'];

        $sql = "delete from colunistas
            where codigo = '$codigo'";

        $resultado = mysql_query($sql);
        if ($resultado) 
        {
            echo "Dados deletados com sucesso meu consagrado. ";
        }
        else 
        {
            echo "Houve algum erro ao deletar. ";
        }
        
    }

    if (isset($_POST['pesquisar']))
    {
        $codigo = $_POST['codigo'];
        $nome = $_POST['nome'];

        $sql = "select * from colunistas";

        $resultado = mysql_query($sql);

        if (mysql_num_rows($resultado) == 0) 
        {
            echo "Desculpe sua pesquisa nao retornou dados. ";
        }
        else 
        {
            echo "Resultado das pesquisas por categorias "."<br> ";
        }
            while ($colunistas = mysql_fetch_array ($resultado)) 
            {
                echo"codigo : ".$colunistas['codigo']."<br>".
                    "nome : ".$colunistas['nome']."<br><br>";
            }
    }
?>
</body>
</html>