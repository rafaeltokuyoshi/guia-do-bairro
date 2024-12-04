<?php
// arquivo alterar_senha.php
include('../conexao.php'); // Certifique-se de incluir a conexão com o banco de dados
include('../protect.php');

if (isset($_POST['email']) && isset($_POST['senha_atual']) && isset($_POST['nova_senha'])) {
    $email = $mysqli->real_escape_string($_POST['email']);
    $senha_atual = $mysqli->real_escape_string($_POST['senha_atual']);
    $nova_senha = $mysqli->real_escape_string($_POST['nova_senha']);

    // Recupere o usuário com base no email
    $sql_code = "SELECT * FROM usuarios WHERE email = '$email' LIMIT 1";
    $sql_query = $mysqli->query($sql_code);

    if (!$sql_query) {
        die("Falha na execução do código SQL: " . $mysqli->error);
    }

    $usuario = $sql_query->fetch_assoc();

    if ($usuario && password_verify($senha_atual, $usuario['senha'])) {
        // A senha atual está correta, vamos atualizar a senha
        $nova_senha_hashed = password_hash($nova_senha, PASSWORD_DEFAULT);
        $update_sql = "UPDATE usuarios SET senha = '$nova_senha_hashed' WHERE email = '$email'";

        if ($mysqli->query($update_sql)) {
            echo "Senha alterada com sucesso!";
            header("refresh: 2;../logout.php");
        } else {
            echo "Erro ao alterar a senha: " . $mysqli->error;
        }
    } else {
        echo "Falha ao alterar a senha! Email ou senha atual incorretos!";
        header("refresh: 2;../perfil.php");
    }
}
?>
