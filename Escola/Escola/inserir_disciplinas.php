<?php
    include("conexao.php");

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        if (isset($_POST['id']) && isset($_POST['nomedisc']) && isset($_POST['cargaHoraria']) && isset($_POST['livro'])) {
            $registro = $_POST['id'];
            $nomedisc = $_POST['nomedisc'];
            $cargaHoraria = $_POST['cargaHoraria'];
            $livro = $_POST['livro'];
    
            $sql = "INSERT INTO disciplina (id, nomedisc, cargaHoraria, livro) VALUES (?, ?, ?, ?)";
            $stmt = $con->prepare($sql);
            $stmt->bind_param("ssss", $id, $nomedisc, $cargaHoraria, $livro);
            $stmt->execute();
    
            if ($stmt->affected_rows === 1) {
                header("Location: disciplinas.php");
                exit;
            }
            
            else {
                echo "Não foi possível cadastrar esta disciplina, tente novamente.";
            }
            $stmt->close();
            $con->close();
        }
    } ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inserir</title>
</head>
<body>

    <h1 class="textTitulo">Insira os Novos Dados</h1>

    <form action="" method="POST">
        <label for="id">Número do Registro</label>
        <input type="text" name="id" id="id" required>
        <label for="nomedisc">Nome</label>
        <input type="text" name="nomedisc" id="nomedisc" required>
        <label for="cargaHoraria">Carga Horária</label>
        <input type="text" name="cargaHoraria" id="cargaHoraria" required>
        <label for="livro">Livro</label>
        <input type="text" name="livro" id="livro" required>

        <button type="submit" class="btn-form" name="btnInserirDisc">OK</button>
    </form>

</body>
</html>
