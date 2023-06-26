<?php
    include("conexao.php");

    if(isset($_POST['btnApagar'])){

        $idProf = $_POST['btnApagar']; 

        //$sql_code = "DELETE FROM Professor WHERE codigo = '$idProf'";
        
        echo $idProf;    
    } 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Lista de Professores</title>

    <link href="estilos/prof.css" rel="stylesheet" text="text/css">
</head>
<body>
    
    <h1>Lista de Professores</h1>

    <br>

    <form action="" method="POST">
    <input type="text" name="tfBuscar" placeholder="Digite um nome...">
    <button type="submit" name="btnBuscar">Buscar</button> <!-- Tem que usar name e não class ou outro, senão não irá funcionar -->
    </form>

    <br>

    <form action="" method="POST">
    <table border="1">
        <tr>
            <th><strong>Código</strong></th>
            <th><strong>Titulação</strong></th>
            <th><strong>Nome</strong></th>
            <th><strong>E-mail</strong></th>
            <th><strong>Apagar</strong></th>
        </tr>
        <?php
            if(isset($_POST['btnBuscar'])){
                $pesquisa = $_POST["tfBuscar"];
                //echo $pesquisa;
                $sql_code = "SELECT * FROM Professor AS p WHERE nome LIKE '%$pesquisa%'";
            }
            else{
            $sql_code = "SELECT * FROM Professor";
            }
            //echo $sql_code;
            $sql_query = $con->query($sql_code);
            while($dados = $sql_query->fetch_assoc()){
            ?>
        <tr>
            <td><?php echo $dados['codigo']?></td>
            <td><?php echo $dados['titulacao']?></td>
            <td><?php echo $dados['nome']?></td>
            <td><?php echo $dados['email']?></td>
        <td>
        <center>
            <button type="submit" name="btnApagar" value="<?php echo $dados['codigo']; ?>">
                <img src="imagens/lixo.png" width="20px" height="20px" alt="apagar">
            </button>
        </center>
        </td>
        </tr>
<?php } ?>
    </table>
    </form>

    <button class="btnMenuProf">
        <a href="index.php" class="linkBtnMenuProf">Menu Principal</a>
    </button>

    <button class="btnInserirProf">
        <a href="inserir_professores.php" class="linkBtnInserirProf">Inserir</a>
    </button>
    
</body>
</html>