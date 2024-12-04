<?php
include('conexao.php');
include('protect.php');
$page = 'cadTipoEmpresa';

$sql_code = "SELECT * from categoriaemp";
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <main class="d-flex flex-nowrap">
        <?php include "menuad.php" ?>
        <div class="container page-content mt-4">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                Cadastrar
            </button>
            <!-- Modal -->
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Cadastro de Categoria</h1>
                            <a type="button" class="btn-close" href="cadTipoEmpresa.php"></a>
                        </div>
                        <div class="modal-body">
                            <form id="name_form">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Nome</label>
                                            <input type="text" class="form-control" name="nomeCategoria"
                                                id="nomeCategoria">
                                            <div class="form-text">Ex: Barberia, Supermercado, Padaria...</div>
                                            <div class="alert " id="alert" role="alert"></div>
                                        </div>
                                    </div>
                                </div>


                        </div>
                        <div class="modal-footer">
                            <a type="button" class="btn btn-secondary" href="cadTipoEmpresa.php">Fechar</a>
                            <input type="button" name="submit" id="submit" class="btn btn-primary" value="Cadastrar">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Fim Modal -->
            <div class="container">
                <div class="row">
                    <div class="col-md-7">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col"></th>
                                        <th scope="col">ID</th>
                                        <th scope="col">Nome</th>
                                    </tr>
                                </thead>
                                <tbody class="customtable">
                                    <?php
                                    while ($categoria = $sql_query->fetch_assoc()) { ?>
                                        <tr>
                                            <td><a href="#" class="edit-category"
                                                    data-id="<?php echo $categoria['id_categoria'] ?>"><i
                                                        class='fa-solid fa-pen'></i></a>

                                                <a href="include/delTipoEmpresa.php?id=<?php echo $categoria['id_categoria'] ?>"
                                                    onclick="return confirm('Tem certeza que deseja excluir esse registro?')"><i
                                                        class='fa-solid fa-trash'></i></a>
                                            </td>
                                            <td>
                                                <?php echo $categoria['id_categoria'] ?>
                                            </td>
                                            <td>
                                                <?php echo $categoria['nomeCategoria'] ?>
                                            </td>
                                        </tr>
                                        <?php
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <!-- Conteúdo do modal de edição aqui -->
                </div>
            </div>
        </div>

    </main>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#submit').click(function () {
                var nomeCategoria = $('#nomeCategoria').val();

                $('#alert').html('');
                if (nomeCategoria == '') {
                    $('#alert').html('Preencha o nome!');
                    $('#alert').addClass("alert-danger");
                    return false;
                }
                $.ajax({
                    url: 'include/acCadTipoEmpresa.php',
                    method: 'POST',
                    data: { nomeCategoria: nomeCategoria },
                    success: function (result) {
                        $('form').trigger("reset");
                        $('#alert').addClass("alert-success");
                        $('#alert').fadeIn().html(result);
                        setTimeout(function () {
                            $('#alert').fadeOut('Slow');
                        }, 3000);
                    }
                })
            });
        });

        $(document).ready(function () {
            $('.edit-category').click(function () {
                var categoriaId = $(this).data('id');
                $.ajax({
                    url: 'include/getTipoEmpresa.php', 
                    method: 'POST',
                    data: { id: categoriaId },
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