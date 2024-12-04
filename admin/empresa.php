<?php
include('conexao.php');
include('protect.php');
$page = 'empresa';

$sql = "SELECT 
    empresas.id_empresas,
    empresas.nome AS nome_empresa,
    empresas.tel_numero,
    empresas.wpp_numero,
    empresas.instagram,
    empresas.facebook,
    empresas.categoria,
    endereco.rua,
    endereco.bairro,
    endereco.cidade,
    endereco.estado,
    endereco.numero,
    endereco.complemento,
    endereco.cep,
    fotos_empresas.nome AS nome_foto,
    fotos_empresas.path AS path_foto,
    fotos_empresas.data_upload AS data_upload_foto
FROM empresas
LEFT JOIN endereco ON empresas.id_empresas = endereco.id_empresas
LEFT JOIN fotos_empresas ON empresas.id_empresas = fotos_empresas.id_empresas ORDER BY empresas.nome asc";

$result = $mysqli->query($sql);

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Administrador</title>
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
        <div class="container-fluid page-content mt-4">
            <div class="table-responsive">
                <table class="table">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col">ID</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Categoria</th>
                            <th scope="col">Telefone</th>
                            <th scope="col">Whatsapp</th>
                            <th scope="col">Imagem</th>
                        </tr>
                    </thead>
                    <tbody class="customtable">
                        <?php $i = 1;
                        while ($row = $result->fetch_assoc()) { ?>
                            <tr>
                                <td><a href="#" class="edit-empresa" data-id="<?php echo $row['id_empresas'] ?>"><i
                                            class='fa-solid fa-pen'></i></a></td>
                                <td><a href="include/delEmpresa.php?id=<?php echo $row['id_empresas'] ?>"
                                        onclick="return confirm('Tem certeza que deseja excluir esse registro?')"><i
                                            class="fa-solid fa-trash"></i></a></td>

                                <td>
                                    <?php echo $row['id_empresas'] ?>
                                </td>
                                <td>
                                    <?php echo $row['nome_empresa'] ?>
                                </td>
                                <td>
                                    <?php echo $row['categoria'] ?>
                                </td>
                                <td>
                                    <?php echo $row["tel_numero"]; ?>
                                </td>
                                <td>
                                    <?php echo $row["wpp_numero"]; ?>
                                </td>
                                <td>
                                    <div class="row justify-content-center">
                                        <div class="col-auto">
                                            <img src="<?php echo "../" . $row['path_foto'] ?>" width="50px" alt="Imagem"
                                                class="img-fluid" data-bs-toggle="modal"
                                                data-bs-target="#imagemModal2<?php echo $i; ?>">
                                        </div>
                                    </div>
                                    <div class="modal fade" id="imagemModal2<?php echo $i ?>" tabindex="-1"
                                        aria-labelledby="imagemModalLabel2" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <img src="<?php echo "../" . $row['path_foto'] ?>" alt="Imagem"
                                                        class="img-fluid">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php $i++;
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- Conteúdo do modal de edição aqui -->
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('.edit-empresa').click(function () {
                var empresaId = $(this).data('id');
                $.ajax({
                    url: 'include/getEmpresa.php',
                    method: 'POST',
                    data: { id: empresaId },
                    success: function (data) {
                        $('#editModal .modal-content').html(data);
                        $('#editModal').modal('show');
                    }
                });
            });
        });
    </script>

</body>

</html>
