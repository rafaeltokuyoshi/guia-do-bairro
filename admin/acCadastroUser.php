<?php
include('conexao.php');
if (isset($_POST['nome']) && isset($_POST['sobrenome']) && isset($_POST['email']) && isset($_POST['senha']) && isset($_POST['senhaconfirm'])) {
    $nome = $mysqli->real_escape_string($_POST['nome']);
    $sobrenome = $mysqli->real_escape_string($_POST['sobrenome']);
    $email = $mysqli->real_escape_string($_POST['email']);
    $senha = $mysqli->real_escape_string($_POST['senha']);
    $senhaconfirm = $mysqli->real_escape_string($_POST['senhaconfirm']);

    // Verifica se todos os campos foram preenchidos
    if (empty($nome) || empty($sobrenome) || empty($email) || empty($senha) || empty($senhaconfirm)) {
        echo "Preencha todos os campos!";
        header("refresh: 1;cadastroUser.php");
    } else {
        $sql_code = "SELECT id FROM usuarios WHERE email = '$email' ";
        $sql_query = $mysqli->query($sql_code) or die("Falha na execução do seu código SQL");

        if ($sql_query->num_rows > 0) {
            echo "O email informado já está cadastrado.";
            header("refresh: 1;cadastroUser.php");
        } elseif ($senha === $senhaconfirm) {
            $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
            $sql_code = "INSERT INTO usuarios (nome, sobrenome, senha, email) VALUES ('$nome', '$sobrenome', '$senha_hash', '$email')";

            if ($mysqli->query($sql_code) === TRUE) {
                echo "Usuário cadastrado com sucesso!";
                header("refresh: 1;login.php");
            } else {
                echo "Erro ao cadastrar usuário: ";
                header("refresh: 1;cadastroUser.php");
            }
        } else {
            echo "As senhas não são iguais!";
            header("refresh: 1;cadastroUser.php");
        }
    }
}

$mysqli->close();
exit();
?>
