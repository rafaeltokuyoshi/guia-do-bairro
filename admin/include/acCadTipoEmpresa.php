<?php
include "../conexao.php";
include('../protect.php');
// Verifica se o nomeCategoria foi enviado via POST
if(isset($_POST['nomeCategoria'])){
    // Prepara a declaração SQL
    $sql_code = "INSERT INTO categoriaemp (nomeCategoria) VALUES (?)";

    // Prepara a declaração SQL e verifica se houve um erro
    if($stmt = $mysqli->prepare($sql_code)){
        // Vincula os parâmetros
        $stmt->bind_param("s", $_POST['nomeCategoria']);

        // Executa a consulta
        if($stmt->execute()){
            echo "Registro salvo com sucesso";
        } else {
            echo "Erro ao salvar";
        }

        // Fecha a declaração
        $stmt->close();
    } else {
        echo "Erro ao preparar a consulta";
    }
} else {
    echo "Nome da categoria não foi enviado via POST";
}

// Fecha a conexão com o banco de dados
$mysqli->close();
?>
