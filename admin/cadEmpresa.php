<?php
include('conexao.php');
include('protect.php');
$page = 'cadEmpresa';
$sql_code = "SELECT * FROM categoriaemp ORDER BY nomeCategoria ASC";
$sql_query = $mysqli->query($sql_code) or die($mysqli->error);
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Administrador </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="../js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <main class="d-flex flex-nowrap">
        <?php include "menuad.php" ?>
        <div class="container page-content mt-4">
            <form id="cadastroForm" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label class="form-label">Nome</label>
                            <input type="text" name="nomeEstabelecimento" class="form-control">
                            <div class="form-text">Digite o nome da empresa!</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Categoria</label>
                            <select class="form-select " name="categoria" aria-label="categoria">
                                <option value="">Selecione uma categoria</option>
                                <?php while ($categoria = $sql_query->fetch_assoc()) { ?>
                                    <option  value="<?php echo $categoria['nomeCategoria'] ?>">
                                        <?php echo $categoria['nomeCategoria'] ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Rua</label>
                            <input type="text" name="rua" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="mb-3">
                            <label class="form-label">Numero</label>
                            <input type="text" name="numeroRua" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Bairro</label>
                            <input type="text" name="bairro" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="mb-3">
                            <label class="form-label">Estado</label>
                            <select class="form-select" name="estado" aria-label="Default select example">
                                <option value="SP">SP</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label">Cidade</label>
                        <select class="form-select" name="cidade" aria-label="Default select example">
                            <option value="Sorocaba">Sorocaba</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Complemento</label>
                            <input type="text" name="complemento" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label class="form-label">CEP</label>
                            <input type="text" name="cep" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                <div class="col-md-3">
                        <label class="form-label">Mural de destaque</label>
                        <select class="form-select" name="destaque" aria-label="Default select example">
                            <option value="Comum">Comum</option>
                            <option value="Destacado">Destacado</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label class="form-label">Telefone</label>
                            <input type="text" name="telefone" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label class="form-label">WhatsApp</label>
                            <input type="text" name="whatsapp" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label class="form-label">Instagram</label>
                            <input type="text" name="instagram" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        <div class="mb-3">
                            <label>Foto, Extensões permitida: JPG, JPEG, PNG.</label>
                            <input type="file" class="form-control" id="file-upload" name="imagem" accept="image/*"
                                required>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Cadastrar</button>
            </form>
        </div>
    </main>

    <script>
        $(document).ready(function () {
            $("#cadastroForm").submit(function (event) {
                event.preventDefault(); // Impede o envio padrão do formulário

                // Crie um objeto FormData para enviar os dados do formulário
                var formData = new FormData(this);

                $.ajax({
                    type: "POST",
                    url: "include/acCadEmpresa.php", // Substitua pelo caminho do seu arquivo PHP de processamento
                    data: formData,
                    processData: false, // Não processar os dados
                    contentType: false, // Não definir o tipo de conteúdo
                    success: function (response) {
                        // Lidar com a resposta do servidor, por exemplo, mostrar uma mensagem de sucesso
                        alert("Empresa cadastrada com sucesso!");
                        // Limpar o formulário após o envio bem-sucedido
                        $("#cadastroForm")[0].reset();
                    },
                    error: function (xhr, status, error) {
                        // Lidar com erros, por exemplo, exibir uma mensagem de erro
                        alert("Erro ao cadastrar a empresa: " + error);
                    },
                });
            });
        });

    </script>

</body>

</html>