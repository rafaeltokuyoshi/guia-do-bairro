<?php
include('../conexao.php');
include('../protect.php');

if (isset($_POST['nomeEstabelecimento'], $_POST['categoria'], $_POST['rua'], $_POST['destaque'], $_POST['numeroRua'], $_POST['bairro'], $_POST['cidade'], $_POST['complemento'], $_POST['cep'], $_POST['telefone'])) {
    // Recuperar os dados do formulário
    $nome = $_POST['nomeEstabelecimento'];
    $categoria = $_POST['categoria'];
    $rua = $_POST['rua'];
    $numeroRua = $_POST['numeroRua'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $complemento = $_POST['complemento'];
    $cep = $_POST['cep'];
    $telefone = $_POST['telefone'];
    $destaque = $_POST['destaque'];
    $whatsapp = isset($_POST['whatsapp']) ? $_POST['whatsapp'] : '';
    $instagram = isset($_POST['instagram']) ? $_POST['instagram'] : '';

    // Inserir os dados na tabela empresas
    $sql = "INSERT INTO empresas (nome, tel_numero, wpp_numero, instagram, categoria, destaque) VALUES (?, ?, ?, ?, ?,?)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ssssss", $nome, $telefone, $whatsapp, $instagram, $categoria,$destaque);
    $stmt->execute();
    $id_empresas = $stmt->insert_id;

    // Inserir os dados na tabela endereco
    $sql_endereco = "INSERT INTO endereco (rua, bairro, cidade, estado, numero, complemento, cep, id_empresas) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt_endereco = $mysqli->prepare($sql_endereco);
    $estado = "SP"; // Substitua pelo estado correto
    $stmt_endereco->bind_param("sssssssi", $rua, $bairro, $cidade, $estado, $numeroRua, $complemento, $cep, $id_empresas);
    $stmt_endereco->execute();

    if (isset($_FILES['imagem'])) {
        $imagemEmp = $_FILES['imagem'];
        if ($imagemEmp['size'] > 10485760) {
            die("Arquivo da foto muito grande! Max: 10 MB");
        }

        $pasta = "../../imgEmp";
        $nomeimagemEmp = $imagemEmp['name'];
        $novonomeimagemEmp = uniqid() . $nomeimagemEmp;
        $extensao = strtolower(pathinfo($nomeimagemEmp, PATHINFO_EXTENSION));

        $pathh = $pasta . '/' . $novonomeimagemEmp . "." . $extensao;
        $caminhoBDFt = "imgEmp/" . $novonomeimagemEmp . "." . $extensao;
        if (move_uploaded_file($imagemEmp["tmp_name"], $pathh)) {
            $sql_foto = "INSERT INTO fotos_empresas (nome, path, id_empresas, data_upload) VALUES (?, ?, ?, NOW())"; // Adicionei uma vírgula entre id_empresas e data_upload
            $stmt_foto = $mysqli->prepare($sql_foto);
            $stmt_foto->bind_param("sss", $nomeimagemEmp, $caminhoBDFt, $id_empresas);
            $stmt_foto->execute();
            $stmt_foto->close();
            header("Location: ../cadEmpresa.php");
            exit();
        } else {
            $nomeimagemEmp = "semarquivo.jpg";
            $caminhoBDFt = "imgEmp/semfoto.jpg";
        }
    }
    $extensoesImagem = array('jpg', 'jpeg', 'png', '');
    if (!in_array($extensao, $extensoesImagem)) {
        echo "Cadastro não realizado. O arquivo foto não é uma imagem JPG, JPEG ou PNG.";
        header("refresh: 2;../cadEmpresa.php");
        exit;
    }

    // Responder ao Ajax (você pode personalizar a resposta conforme necessário)
    echo "Cadastro realizado com sucesso!";
}

// Fechar a conexão com o banco de dados
$mysqli->close();
?>
