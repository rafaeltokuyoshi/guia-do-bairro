<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Dados do formulário
    $name = htmlspecialchars($_POST["name"]);
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $phone = htmlspecialchars($_POST["phone"]);
    $objetivo = htmlspecialchars($_POST["objetivo"]);
    $descricao = htmlspecialchars($_POST["descricao"]);

    // Validação dos campos
    if (empty($name) || empty($email) || empty($descricao)) {
        // Campos obrigatórios não preenchidos
        echo "Por favor, preencha todos os campos obrigatórios.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Verifique o formato do email
        echo "O endereço de e-mail fornecido é inválido.";
    } else {
        // Configurações de e-mail
        $to = "matheushs_s@hotmail.com";
        $subject = "Formulário de Contato - $name";
        $message = "Nome: $name\n";
        $message .= "E-mail: $email\n";
        $message .= "Telefone: $phone\n";
        $message .= "Objetivo: $objetivo\n";
        $message .= "Mensagem:\n$descricao";

        // Envia o e-mail
        if (mail($to, $subject, $message)) {
            echo "O seu formulário foi enviado com sucesso!";
        } else {
            echo "Houve um erro ao enviar o formulário. Por favor, tente novamente mais tarde.";
        }
    }
}
?>
