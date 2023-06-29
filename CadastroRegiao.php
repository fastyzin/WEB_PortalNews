<?php
    $conectar = mysql_connect('localhost','root','');
    $banco    = mysql_select_db('portal');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Regiões </title>
    <link rel="icon" type="image/png" href="icon.png">
</head>
<body>
<div id="cabecalho"> 
        <center> <img src="logo.png" width="235" height="100"> </center>
</div>
    <br><h1><center>Cadastro das Regiões</center></h1><br>
    <form name="form" method="post" action="CadastroRegiao.php">
        Codigo <input type="text" name="codigo" id="codigo" size="10"> 
        <br>
        <br>
        Nome<input type="text" name="nome" id="nome" size="50">
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
            font-family: Arial;
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
            color: white;
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
            $sql = "insert into regiao (codigo,nome)
                    values ('$codigo', '$nome')";

            $resultado = mysql_query($sql);

            if ($resultado){
                echo "Dados enviados com sucesso. ";
            }
            else {
                echo "Erro ao enviar dados";
            }
        }

        if (isset($_POST['alterar']))
        {
            $codigo = $_POST['codigo'];
            $nome = $_POST['nome'];

            $sql = "update regiao set nome = '$nome'
            where codigo = '$codigo'";

            $resultado = mysql_query($sql);
            if($resultado) {
                echo "Dados alterados com sucesso meu consagrado. ";
            }
            else {
                echo "Erro ao alterar os dados. ";
            }
        }

        if (isset($_POST['excluir']))
        {
            $codigo = $_POST['codigo'];
            $nome = $_POST['nome'];

            $sql = "delete from regiao
                where codigo = '$codigo'";

            $resultado = mysql_query($sql);
            if ($resultado) {
                echo "Dados deletados com sucesso meu consagrado. ";
            }
            else {
                echo "Houve algum erro ao deletar. ";
            }
            
        }

        if (isset($_POST['pesquisar']))
        {
            $codigo = $_POST['codigo'];
            $nome = $_POST['nome'];

            $sql = "select * from regiao";

            $resultado = mysql_query($sql);

            if (mysql_num_rows($resultado) == 0) {
                echo "Desculpe sua pesquisa nao retornou dados. ";

            }
            else {
                echo "Resultado das pesquisas por categorias "."<br> ";
            }
                while ($regiao = mysql_fetch_array ($resultado)) {
                echo"codigo : ".$regiao['codigo']."<br>".
                    "nome : ".$regiao['nome']."<br><br>";
            }
        }
    ?>
</body>
</html>