<?php
include('../conexao.php');
include('../protect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Certifique-se de validar e filtrar os dados recebidos via POST
    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
    $nomeEmpresa = filter_input(INPUT_POST, 'nomeEmpresa', FILTER_SANITIZE_STRING);
    $telNumero = filter_input(INPUT_POST, 'telNumero', FILTER_SANITIZE_STRING);
    $wppNumero = filter_input(INPUT_POST, 'wppNumero', FILTER_SANITIZE_STRING);
    $instagram = filter_input(INPUT_POST, 'instagram', FILTER_SANITIZE_STRING);
    $facebook = filter_input(INPUT_POST, 'facebook', FILTER_SANITIZE_STRING);
    $categoria = filter_input(INPUT_POST, 'categoria', FILTER_SANITIZE_STRING);
    $rua = filter_input(INPUT_POST, 'rua', FILTER_SANITIZE_STRING);
    $bairro = filter_input(INPUT_POST, 'bairro', FILTER_SANITIZE_STRING);
    $cidade = filter_input(INPUT_POST, 'cidade', FILTER_SANITIZE_STRING);
    $estado = filter_input(INPUT_POST, 'estado', FILTER_SANITIZE_STRING);
    $numero = filter_input(INPUT_POST, 'numero', FILTER_SANITIZE_STRING);
    $complemento = filter_input(INPUT_POST, 'complemento', FILTER_SANITIZE_STRING);
    $cep = filter_input(INPUT_POST, 'cep', FILTER_SANITIZE_STRING);
    $destaque = filter_input(INPUT_POST, 'destaque', FILTER_SANITIZE_STRING);
    // Iniciar uma transação
    $mysqli->begin_transaction();

    // Atualize os dados na tabela "empresas"
    $sqlEmpresa = "UPDATE empresas SET
        nome = '$nomeEmpresa',
        tel_numero = '$telNumero',
        wpp_numero = '$wppNumero',
        instagram = '$instagram',
        facebook = '$facebook',
        categoria = '$categoria',
        destaque = '$destaque'
        WHERE id_empresas = $id";

    if ($mysqli->query($sqlEmpresa) === TRUE) {
        // Atualização bem-sucedida na tabela "empresas"
        // Agora, atualize os dados na tabela "endereco"
        $sqlEndereco = "UPDATE endereco SET
            rua = '$rua',
            bairro = '$bairro',
            cidade = '$cidade',
            estado = '$estado',
            numero = '$numero',
            complemento = '$complemento',
            cep = '$cep'
            WHERE id_empresas = $id";

        if ($mysqli->query($sqlEndereco) === TRUE) {
            // Atualização bem-sucedida na tabela "endereco"   
            if (!empty($_FILES['novaImagem']['name'])) {
                // Verificar o tamanho do arquivo
                $tamanhoMaximo = 10 * 1024 * 1024; // 10 MB em bytes
                if ($_FILES['novaImagem']['size'] > $tamanhoMaximo) {
                    // O arquivo excede o tamanho máximo permitido
                    echo "Erro: O tamanho do arquivo deve ser no máximo 10 MB.";
                    exit;
                }

                // Verificar a extensão do arquivo
                $extensoesPermitidas = array('jpg', 'jpeg', 'png');
                $extensaoArquivo = strtolower(pathinfo($_FILES['novaImagem']['name'], PATHINFO_EXTENSION));
                if (!in_array($extensaoArquivo, $extensoesPermitidas)) {
                    // Extensão de arquivo não permitida
                    echo "Erro: Apenas arquivos JPG, JPEG e PNG são permitidos.";
                    exit;
                }

                // Remover a imagem anterior, se existir
                if (!empty($fotos['fotoPath']) && file_exists($fotos['fotoPath'])) {
                    unlink($fotos['fotoPath']);
                }

                // Gerar um nome único para a imagem
                $nomeImagem = uniqid() . '_' . $_FILES['novaImagem']['name'];

                // Definir o caminho completo da imagem
                $caminhoImagem = "imgEmp/" . $nomeImagem;
                $caminhoMove = "../../imgEmp/" . $nomeImagem ;

                // Upload da nova imagem
                move_uploaded_file($_FILES['novaImagem']['tmp_name'], $caminhoMove);

                // Atualizar o caminho da imagem no banco de dados
                $sql_update_imagem = "UPDATE fotos_empresas SET nome = ?, path = ? WHERE id_empresas = ?";
                $stmt_imagem = $mysqli->prepare($sql_update_imagem);
                $stmt_imagem->bind_param("ssi", $nomeImagem, $caminhoImagem, $id);
                $stmt_imagem->execute();

                $stmt_imagem->close();
            }
            // Faça commit da transação
            $mysqli->commit();

            // Você pode redirecionar o usuário para uma página de sucesso ou fazer qualquer outra ação necessária

        } else {
            // Erro na atualização da tabela "endereco"
            // Faça rollback da transação
            $mysqli->rollback();

            // Você pode redirecionar o usuário para uma página de erro ou mostrar uma mensagem de erro na mesma página
            echo "Erro na atualização da tabela 'endereco': " . $mysqli->error;
        }
    } else {
        // Erro na atualização da tabela "empresas"
        // Faça rollback da transação
        $mysqli->rollback();

        // Você pode redirecionar o usuário para uma página de erro ou mostrar uma mensagem de erro na mesma página
        echo "Erro na atualização da tabela 'empresas': " . $mysqli->error;
    }

    // Encerrar a transação manualmente
    $mysqli->close();
    header("Location: ../empresa.php");
} else {
    // Redirecionar para a página de origem ou mostrar uma mensagem de erro, caso necessário
    header("Location: index.php");
    exit();
}
?>
