<?php
include "../conexao.php";
include('../protect.php');

if(!empty($_GET['id'])){
    $id =$_GET['id'];
    $sql_code = "SELECT * FROM fotos_site WHERE fotos_site . id_foto = '$id'";
    $result = $mysqli->query($sql_code);
    
    if($result->num_rows > 0){
        $sql_code = "DELETE FROM fotos_site WHERE fotos_site . id_foto  = '$id'";
        $result = $mysqli->query($sql_code);
    }
}

$mysqli->close();
header("refresh: 0;../cadBanner.php");
exit();
?>