<?php
    $conectar = mysql_connect('localhost','root','');
    $banco    = mysql_select_db('portal');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro das matérias  </title>
    <link rel="icon" type="image/png" href="icon.png">

</head>
<body>
<div id="cabecalho"> 
    <center> <img src="logo.png" width="235" height="100"> </center>
</div>
<br><h1><center> Cadastro das matérias</center></h1><br>
    <form name="form" method="post" action="CadastroMaterias.php" enctype="multipart/form-data">
        Codigo: <input type="text" name="codigo" id="codigo" size="20">
        <br>
        <br>
        Data: <input type="date" name="data" id="data" size="20">
        <br>
        <br>
        Hora: <input type="time" name="time" id="time" size="20">
        <br>
        <br>
        Codigo Região: <input type="text" name="codregiao" id="codregiao" size="20">
        <br>
        <br>
        Codigo Categoria: <input type="text" name="codcategoria" id="codcategoria" size="20">
        <br>
        <br>
        Codigo Colunista: <input type="text" name="codcolunista" id="codcolunista" size="20">
        <br>
        <br>
        Chamada: <input type="text" name="chamada" id="chamada" size="20">
        <br>
        <br>
        Resumo: <input type="text" name="resumo" id="resumo" size="20">
        <br>
        <br>
        Materia: <input type="textarea" name="materia" id="materia" size="20">
        <br>
        <br>
        Foto chamada: <input type="file" name="fotochamada" id="fotochamada">
        <br>
        <br>
        Foto 1: <input type="file" name="foto1" id="foto1"> 
        <br>
        <br>
        Foto 2: <input type="file" name="foto2" id="foto2">
        <div id='button'>
            <input type="submit" name="gravar" id="gravar" value="Gravar">
            <input type="submit" name="alterar" id="alterar" value="Alterar">
            <input type="submit" name="excluir" id="excluir" value="Excluir">
            <input type="submit" name="pesquisar" id="pesquisar" value="Pesquisar">
        </div>
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
        font-weight: Bold;
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
            $data = $_POST['data'];
            $hora = $_POST['time'];
            $codregiao = $_POST['codregiao'];
            $codcategoria = $_POST['codcategoria'];
            $codcolunista = $_POST['codcolunista'];
            $chamada = $_POST['chamada'];
            $resumo = $_POST['resumo'];
            $materia = $_POST['materia'];
            $fotochamada = $_FILES['fotochamada'];
            $foto1 = $_FILES['foto1'];
            $foto2 = $_FILES['foto2'];
            $pasta = "fotos/"; 

            $fotochamada_nome = $pasta . $fotochamada["name"];
            $foto1_nome = $pasta . $foto1["name"];
            $foto2_nome = $pasta . $foto2["name"];
        
            move_uploaded_file($fotochamada["tmp_name"], $fotochamada_nome);
            move_uploaded_file($foto1["tmp_name"], $foto1_nome);
            move_uploaded_file($foto2["tmp_name"], $foto2_nome);

            $sql = "insert into materias (codigo,data,hora,codregiao,codcategoria,codcolunista,chamada,resumo,materia,fotochamada,foto1,foto2)
            values ('$codigo', '$data', '$hora', '$codregiao', '$codcategoria', '$codcolunista', '$chamada', '$resumo', '$materia', '$fotochamada_nome', '$foto1_nome', '$foto2_nome')";


            $resultado = mysql_query($sql);
            
            
            if ($resultado) {
                echo "<center><font family='Arial' size='4'>Dados enviados com sucesso.</font></center>";
            } else {
                echo "<center><font family='Arial' size='4'>Erro ao enviar dados</font></center>";
            }
        }

        if (isset($_POST['alterar']))
        {
            $codigo = $_POST['codigo'];
            $data = $_POST['data'];
            $hora = $_POST['time'];
            $codregiao = $_POST['codregiao'];
            $codcategoria = $_POST['codcategoria'];
            $codcolunista = $_POST['codcolunista'];
            $chamada = $_POST['chamada'];
            $resumo = $_POST['resumo'];
            $materia = $_POST['materia'];
            $fotochamada = $_FILES['fotochamada'];
            $foto1 = $_FILES['foto1'];
            $foto2 = $_FILES['foto2'];

            $sql = "UPDATE materias SET resumo = '$resumo', materia = '$materia' WHERE codigo = '$codigo'";


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
            $data = $_POST['data'];
            $hora = $_POST['time'];
            $codregiao = $_POST['codregiao'];
            $codcategoria = $_POST['codcategoria'];
            $codcolunista = $_POST['codcolunista'];
            $chamada = $_POST['chamada'];
            $resumo = $_POST['resumo'];
            $materia = $_POST['materia'];
            $fotochamada = $_FILES['fotochamada'];
            $foto1 = $_FILES['foto1'];
            $foto2 = $_FILES['foto2'];

            $sql = "delete from materias
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
            $data = $_POST['data'];
            $hora = $_POST['time'];
            $codregiao = $_POST['codregiao'];
            $codcategoria = $_POST['codcategoria'];
            $codcolunista = $_POST['codcolunista'];
            $chamada = $_POST['chamada'];
            $resumo = $_POST['resumo'];
            $materia = $_POST['materia'];
            $fotochamada = $_FILES['fotochamada'];
            $foto1 = $_FILES['foto1'];
            $foto2 = $_FILES['foto2'];

            $sql = "select * from materias";

            $resultado = mysql_query($sql);

            if (mysql_num_rows($resultado) == 0) 
            {
                echo "Desculpe sua pesquisa nao retornou dados. <br>";
            }
            else 
            {
                echo "Resultado das pesquisas "." ";
            }
                while ($materias = mysql_fetch_array ($resultado)) 
                {
                    echo"codigo : ".$materias['codigo']."<br>".
                        "Data : ".$materias['data'].'<br>'.
                        "Hora : ".$materias['hora']."<br>".
                        "Cod. Região : ".$materias['codregiao']."<br>".
                        "Cod. Categoria : ".$materias['codcategoria']."<br>".
                        "Cod. Colunista : ".$materias['codcolunista']."<br>".
                        "Chmada : ".$materias['chamada']."<br>".
                        "Resumo : ".$materias['resumo']."<br>".
                        "Matéria : ".$materias['materia']."<br>"."<br><br>";
                }
        }
    ?>
</body>
</html>