<?php
include('../conexao.php');
include('../protect.php');

if (isset($_POST['lugar'])) {
    $lugar = $_POST['lugar'];
    if (isset($_FILES['imagem'])) {
        $imagemBanner = $_FILES['imagem'];
        if ($imagemBanner['size'] > 10485760) {
            die("Arquivo da foto muito grande! Max: 10 MB");
        }

        $pasta = "../../img";
        $nomeImagemBanner = $imagemBanner['name'];
        $extensao = strtolower(pathinfo($nomeImagemBanner, PATHINFO_EXTENSION));

        // Verificar se já existe uma imagem para o lugar e excluí-la
        $sql_check = "SELECT path FROM fotos_site WHERE lugar = ?";
        $stmt_check = $mysqli->prepare($sql_check);
        $stmt_check->bind_param("s", $lugar);
        $stmt_check->execute();
        $stmt_check->store_result();

        if ($stmt_check->num_rows > 0) {
            $stmt_check->bind_result($imagemAntiga);
            $stmt_check->fetch();
            unlink($imagemAntiga); // Exclui a imagem antiga
        }

        $novonomeImagemBanner = uniqid();
        $pathh = $pasta . '/' . $novonomeImagemBanner . "." . $extensao;
        $caminhoBDFt = "img/" . $novonomeImagemBanner . "." . $extensao;

        if (move_uploaded_file($imagemBanner["tmp_name"], $pathh)) {
            // Inserir a nova imagem
            $sql_foto = "INSERT INTO fotos_site (nome, path, lugar, data_upload) VALUES (?, ?, ?, NOW())";
            $stmt_foto = $mysqli->prepare($sql_foto);
            $stmt_foto->bind_param("sss", $nomeImagemBanner, $caminhoBDFt, $lugar);
            $stmt_foto->execute();
            $stmt_foto->close();
            header("Location: ../cadBanner.php");
            exit();
        } else {
            $nomeImagemBanner = "semarquivo.jpg";
            $caminhoBDFt = "img/semfoto.jpg";
        }

        $stmt_check->close();
    }
}
/*
CADASTRO VARIAS FOTOS
include('../conexao.php');
include('../protect.php');
if (isset($_POST['lugar'])) {
$lugar = $_POST['lugar'];
if (isset($_FILES['imagem'])) {
$imagemBanner = $_FILES['imagem'];
if ($imagemBanner['size'] > 10485760) {
die("Arquivo da foto muito grande! Max: 10 MB");
}

$pasta = "../../img";
$nomeImagemBanner = $imagemBanner['name'];
$novonomeImagemBanner = uniqid();
$extensao = strtolower(pathinfo($nomeImagemBanner, PATHINFO_EXTENSION));

$pathh = $pasta . '/' . $novonomeImagemBanner . "." . $extensao; // Corrigido: Adicionado '/' para o caminho do arquivo
$caminhoBDFt = "../img/" . $novonomeImagemBanner . "." . $extensao;
if (move_uploaded_file($imagemBanner["tmp_name"], $pathh)) {
$sql_foto = "INSERT INTO fotos_site (nome, path, lugar, data_upload) VALUES (?, ?, ?, NOW())";
$stmt_foto = $mysqli->prepare($sql_foto);
$stmt_foto->bind_param("sss", $nomeImagemBanner, $caminhoBDFt, $lugar);
$stmt_foto->execute();
$stmt_foto->close();
header("Location: ../cadBanner.php"); // Corrigido: Formato do header
exit();
} else {
$nomeImagemBanner = "semarquivo.jpg";
$caminhoBDFt = "img/semfoto.jpg";
}
}
}
*/
?>












