<?php
include "../conexao.php";
include('../protect.php');

if(!empty($_GET['id'])){
    $id =$_GET['id'];
    $sql_code = "SELECT * FROM categoriaemp WHERE categoriaemp . id_categoria = '$id'";
    $result = $mysqli->query($sql_code);
    
    if($result->num_rows > 0){
        $sql_code = "DELETE FROM categoriaemp WHERE categoriaemp . id_categoria = '$id'";
        $result = $mysqli->query($sql_code);
    }
}

$mysqli->close();
header("refresh: 0;../cadTipoEmpresa.php");
exit();
?>