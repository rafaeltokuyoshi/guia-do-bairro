<?php
include('conexao.php');
include('protect.php');
$page = 'cadBanner';
$sql = "SELECT * from fotos_site";
$resultado = $mysqli->query($sql);

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
</head>

<body>
    <main class="d-flex flex-nowrap">
        <?php include "menuad.php" ?>
        <div class="container page-content mt-4">
            <h2>Cadastro de Foto</h2>
            <h4 class="mt-2">Banner</h4>
            <div class="row">
                <div class="col-md-6">
                    <form action="include/acCadBanner.php" method="post" enctype="multipart/form-data">
                        <select class="form-select" name="lugar" aria-label="Default select example">
                            <option value="banner">Banner</option>
                        </select>
                        <div class="mb-3">
                            <label>Foto, Extensões permitida: JPG, JPEG, PNG.</label>
                            <input type="file" class="form-control" id="file-upload" name="imagem" accept="image/*"
                                required>
                        </div>
                        <button type="submit" class="btn btn-primary">Cadastrar</button>
                    </form>
                </div>
                <div class="container mt-4">
                    <div class="row">
                        <?php $i = 1;
                        if ($resultado->num_rows > 0) {
                            while ($row = $resultado->fetch_assoc()) {
                                $nomeImagem = $row['nome'];
                                $caminhoImagem = $row['path'];
                                ?>
                                <div class="col-md-4">
                                    <div class="thumbnail">
                                        <img src="<?php echo "../" . $caminhoImagem; ?>" width="350px"
                                            alt="<?php echo $caminhoImagem; ?>" class="img-fluid" data-bs-toggle="modal"
                                            data-bs-target="#imagemModal2<?php echo $i; ?>">
                                        <div class="caption text-center">
                                            <a class="btn btn-primary mt-2" href="include/delFotoSite.php?id=<?php echo $row['id_foto'] ?>"
                                                onclick="return confirm('Tem certeza que deseja excluir esse registro?')"><i class="fa-solid fa-trash" style="color: #0a2a94;"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal para a primeira imagem -->
                                <div class="modal fade" id="imagemModal2<?php echo $i; ?>" tabindex="-1"
                                    aria-labelledby="imagemModalLabel2" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <img src="<?php echo "../" . $caminhoImagem; ?>" alt="Imagem" class="img-fluid">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php $i++;
                            }
                            ?>
                        <?php
                        } else {
                            echo "Nenhuma imagem cadastrada.";
                        } ?>
                    </div>
                </div>

                <!-- Modal para a primeira imagem -->
                <div class="modal fade" id="imagemModal2" tabindex="-1" aria-labelledby="imagemModalLabel2"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">
                                <img src="../img/call.jpeg" alt="Imagem" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>

</body>

</html>