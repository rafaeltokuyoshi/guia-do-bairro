<?php
// arquivo acLoginUser.php
include('conexao.php');
if (isset($_POST['email']) && isset($_POST['senha'])) {
    if (strlen($_POST['email']) == 0) {
        echo "Preencha o Email!";
        header("refresh: 1;login.php");
    } elseif (strlen($_POST['senha']) == 0) {
        echo "Preencha a senha!";
        header("refresh: 1;login.php");
    } else {
        $email = $mysqli->real_escape_string($_POST['email']);
        $senha = $mysqli->real_escape_string($_POST['senha']);
        $sql_code = "SELECT * FROM usuarios WHERE email = '$email' LIMIT 1";
        $sql_query = $mysqli->query($sql_code);
        if (!$sql_query) {
            die("Falha na execução do código SQL: " . $mysqli->error);
        }
        $usuario = $sql_query->fetch_assoc();
        if ($usuario && password_verify($senha, $usuario['senha'])) {
            if (!isset($_SESSION)) {
                session_start();
            }
            $_SESSION['id'] = $usuario['id'];
            $_SESSION['nome'] = $usuario['nome'];
            $_SESSION['sobrenome'] = $usuario['sobrenome'];
            $_SESSION['email'] = $usuario['email'];
            header("Location: painel.php");
            exit;
        } else {
            echo "Falha ao logar! Email ou senha incorretos!";
            header("refresh: 2;loginact.php");
        }
    }
}
?>
