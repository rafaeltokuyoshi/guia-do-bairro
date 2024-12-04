<?php
include "../conexao.php";
include('../protect.php');

if(!empty($_GET['id'])){
    $id =$_GET['id'];
    $sql_code = "SELECT * FROM empresas WHERE empresas . id_empresas = '$id'";
    $result = $mysqli->query($sql_code);
    
    if($result->num_rows > 0){
        $sql_code = "DELETE empresas, endereco, fotos_empresas
        FROM empresas
        LEFT JOIN endereco ON empresas.id_empresas = endereco.id_empresas
        LEFT JOIN fotos_empresas ON empresas.id_empresas = fotos_empresas.id_empresas
        WHERE empresas.id_empresas =  '$id'";
        $result = $mysqli->query($sql_code);

    }
}

$mysqli->close();
header("refresh: 0;../empresa.php");
exit();
?>