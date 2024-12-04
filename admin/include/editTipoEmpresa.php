<?php
// Inclua a conexão com o banco de dados e qualquer lógica de verificação de sessão, se necessário
include('../conexao.php');
include('../protect.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Certifique-se de validar e filtrar os dados recebidos via POST
    $categoriaId = filter_input(INPUT_POST, 'id_categoria', FILTER_SANITIZE_NUMBER_INT);
    $nomeCategoria = filter_input(INPUT_POST, 'nomeCategoria', FILTER_SANITIZE_STRING);

    // Consulta SQL para atualizar os dados da categoria no banco de dados
    $sql = "UPDATE categoriaemp SET nomeCategoria = '$nomeCategoria' WHERE id_categoria = $categoriaId";

    if ($mysqli->query($sql) === TRUE) {
        header("Location: ../cadtipoempresa.php");
    } else {
        echo 'Erro ao atualizar a categoria: ' . $mysqli->error;
    }
} else {
    echo 'Requisição inválida.';
}
?>
