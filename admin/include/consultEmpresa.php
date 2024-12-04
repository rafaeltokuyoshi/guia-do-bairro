<?php
include "../conexao.php";
include('../protect.php');

// Consulta SQL para buscar todas as empresas
$sql = "SELECT * FROM empresas";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    // Inicie a tabela HTML
    echo "<table border='1'>
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Telefone</th>
        <th>WhatsApp</th>
        <th>Instagram</th>
    </tr>";

    // Exibir os dados das empresas
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id_empresas"] . "</td>";
        echo "<td>" . $row["nome"] . "</td>";
        echo "<td>" . $row["tel_numero"] . "</td>";
        echo "<td>" . $row["wpp_numero"] . "</td>";
        echo "<td>" . $row["instagram"] . "</td>";
        echo "</tr>";
    }

    // Feche a tabela HTML
    echo "</table>";
} else {
    echo "Nenhuma empresa encontrada.";
}

// Feche a conexão com o banco de dados
$mysqli->close();
?>
