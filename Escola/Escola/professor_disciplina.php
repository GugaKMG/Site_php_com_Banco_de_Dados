<?php 
    include("conexao.php");

    if(isset($_POST['btnApagar'])){
        $idDisc = $_POST['btnApagar'];

        //$sql_code = "DELETE FROM Disciplina WHERE id = '$idDisc'";

        echo $idDisc;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Disciplinas e Professores</title>
</head>
<body>
    
    <h1>Lista de Disciplinas e Professores</h1>

    <br>

    <form action="" method="POST">
    <input type="text" name="tfBuscar" placeholder="Digite um nome...">
    <button type="submit" name="btnBuscar">Buscar</button> <!-- Tem que usar name e não class ou outro, senão não irá funcionar -->
    </form>

    <br>

    <form action="" method="POST">
    <table border="1">
        <tr>
            <th><strong>Código da Disciplina</strong></th>
            <th><strong>Nome da Disciplina</strong></th>
            <th><strong>Carga Horária</strong></th>
            <th><strong>Livro</strong></th>
            <th><strong>Código do Professor</strong></th>
            <th><strong>Nome do Professor</strong></th>
            <th><strong>email</strong></th>
            <th><strong>titulação</strong></th>
            <th><strong>idade</strong></th>
            <th><strong>Apagar</strong></th>
        </tr>
        <?php
            if(isset($_POST['btnBuscar'])){
                $pesquisa = $_POST["tfBuscar"];
                //echo $pesquisa;
                $sql_code = "SELECT * FROM Professor AS p INNER JOIN Turma AS t INNER JOIN Disciplina AS d ON p.codigo = t.professor AND d.id = t.disciplina 
                WHERE nomedisc LIKE '%$pesquisa%' OR nome LIKE '%$pesquisa%' ORDER BY p.nome";
            }
            else{
                $sql_code = "SELECT * FROM Professor AS p INNER JOIN Turma AS t INNER JOIN Disciplina AS d 
                ON p.codigo = t.professor AND d.id = t.disciplina ORDER BY p.nome";
            }
            //echo $sql_code;
            $sql_query = $con->query($sql_code);
            while($dados = $sql_query->fetch_assoc()){
            ?>
        <tr>
            <td><?php echo $dados['id']?></td>
            <td><?php echo $dados['nomedisc']?></td>
            <td><?php echo $dados['cargaHoraria']?></td>
            <td><?php echo $dados['livro']?></td>
            <td><?php echo $dados['codigo']?></td>
            <td><?php echo $dados['nome']?></td>
            <td><?php echo $dados['email']?></td>
            <td><?php echo $dados['titulacao']?></td>
            <td><?php echo $dados['ano']?></td>
        <td>
        <center>
            <button type="submit" name="btnApagar" value="<?php echo $dados['id'];?>">
                <img src="imagens/lixo.png" width="20px" height="20px" alt="apagar">
            </button>
        </center>
        </td>
        </tr>
<?php } ?>
    </table>
    </form>

        <button class="btnMenuDisc">
                <a href="index.php" class="linkMenuDisc">Menu Principal</a>
        </button>

</body>
</html>