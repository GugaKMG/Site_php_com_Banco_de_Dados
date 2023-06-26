<?php
    include("conexao.php");

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        if (isset($_POST['codigo']) && isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['titulacao']) && isset($_POST['dataNascimento'])) {
            $codigo = $_POST['codigo'];
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $titulacao = $_POST['titulacao'];
            $dataNascimento = $_POST['dataNascimento'];
    
            $sql = "INSERT INTO professor (codigo, nome, email, titulacao, dataNascimento) VALUES (?, ?, ?, ?, ?)";
            $stmt = $con->prepare($sql);
            $stmt->bind_param("sssss", $codigo, $nome, $email, $titulacao, $dataNascimento);
            $stmt->execute();
    
            if ($stmt->affected_rows === 1) {
                header("Location: professores.php");
                exit;
            }
            
            else {
                echo "Não foi possível cadastrar este professor, tente novamente.";
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

    <h1 class="tituloProfInserir">Insira os Novos Dados</h1>

    <form action="" method="POST">
        <label for="codigo">Código</label>
        <input type="text" name="codigo" id="codigo" required>
        <label for="nome">Nome</label>
        <input type="text" name="nome" id="nome" required>
        <label for="email">Email</label>
        <input type="text" name="email" id="email" required>
        <label for="titulacao">Titulação(Abreviado, <strong>dr</strong> = doutorado, <strong>msr</strong> = mestrado, <strong>espec</strong> = especializado, <strong>grad</strong> = graduação)</label>
        <input type="text" name="titulacao" id="titulacao" required>
        <label for="dataNascimento">Data de Nascimento</label>
        <input type="date" name="dataNascimento" id="dataNascimento" required>

        <button type="submit" class="btn-form" name="btnInserirProf">OK</button>
    </form>

</body>
</html>
