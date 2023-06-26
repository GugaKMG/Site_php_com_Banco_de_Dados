<?php 
    include("conexao.php");

    if(isset($_POST['btnApagar'])){
        $idaluno = $_POST['btnApagar'];

        //$sql_code = "DELETE FROM Aluno WHERE registro = '$idaluno'";

        echo $idaluno;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Alunos</title>
</head>
<body>
    
    <h1>Lista de Alunos</h1>

    <br>

    <form action="" method="POST">
        <input type="text" name="tfBuscar" placeholder="Digite o nome do aluno">
        <button type="submit" name="btnBuscar">Buscar</button>
    </form>

    <form action="" method="POST">
    <table border="1">
      <tr>
        <th>Código</th>
        <th>Nome</th>
        <th>Data de Nascimento</th>
        <th>Apagar</th>
      </tr>

      <?php 
        if(isset($_POST['btnBuscar'])){
            $pesquisa = $_POST["tfBuscar"];
            //echo $pesquisa;
            $sql_code = "SELECT * FROM Aluno WHERE nome LIKE '%$pesquisa%' ORDER BY nome";
        }
        else{
        $sql_code = "SELECT * FROM Aluno ORDER BY nome";
        }

        $sql_query = $con->query($sql_code);
        while($dados = $sql_query->fetch_assoc()) {
      ?>

      <tr>
        <td><?php echo $dados['registro']?></td>
        <td><?php echo $dados['nome']?></td>
        <td><?php echo $dados['dataNascimento']?></td>
        <td>
        <center>
            <button type="submit" name="btnApagar" value="<?php echo $dados['registro']?>">
                <img src="imagens/lixo.png" width="20px" height="20px" alt="apagar">
            </button>
        </center>
        </td>
      </tr>
<?php } ?>
    </table>
    </form>

    <button>
    <a href="index.php">Menu Principal</a>
    </button>

    <button>
        <a href="inserir_aluno.php">Inserir</a>
    </button>

</body>
</html>