<?php
    include("conexao.php");

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        if (isset($_POST['registro']) && isset($_POST['nome']) && isset($_POST['dataNascimento'])) {
            $registro = $_POST['registro'];
            $nome = $_POST['nome'];
            $dataNascimento = $_POST['dataNascimento'];
    
            $sql = "INSERT INTO aluno (registro, nome, dataNascimento) VALUES (?, ?, ?)";
            $stmt = $con->prepare($sql);
            $stmt->bind_param("sss", $registro, $nome, $dataNascimento);
            $stmt->execute();
    
            if ($stmt->affected_rows === 1) {
                header("Location: alunos.php");
                exit;
            }
            
            else {
                echo "Não foi possível cadastrar esse aluno, tente novamente.";
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
        <label for="codigo">Código</label>
        <input type="text" name="registro" id="registro" required>
        <label for="nome">Nome</label>
        <input type="text" name="nome" id="nome" required>
        <label for="email">Email</label>
        <input type="date" name="dataNascimento" id="dataNascimento" required>
        <label for="titulacao">Titulação(Abreviado)</label>
        <input type=""
        <button type="submit" class="btn-form" name="btnInserir">OK</button>
    </form>

</body>
</html>
