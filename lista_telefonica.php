<?php
include('admin/conexao.php');
$page = "lista";
$itensPorPagina = 10;
$pagina = isset($_GET['pagina']) ? intval($_GET['pagina']) : 0;



$offset = $pagina * $itensPorPagina;
// Adicione esta linha após a definição de $pagina
$pesquisa = isset($_GET['pesquisa']) ? $mysqli->real_escape_string($_GET['pesquisa']) : '';

// Atualize a consulta SQL para incluir a cláusula WHERE, se a pesquisa estiver presente
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
LEFT JOIN fotos_empresas ON empresas.id_empresas = fotos_empresas.id_empresas
WHERE empresas.nome LIKE '%$pesquisa%' OR empresas.categoria LIKE '%$pesquisa%'
ORDER BY empresas.nome asc
LIMIT $offset, $itensPorPagina";



$result = $mysqli->query($sql);

// Calcular o número total de páginas
$num = $result->num_rows;
$numTotal = $mysqli->query("SELECT 
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
LEFT JOIN fotos_empresas ON empresas.id_empresas = fotos_empresas.id_empresas
WHERE empresas.nome LIKE '%$pesquisa%' OR empresas.categoria LIKE '%$pesquisa%'
ORDER BY empresas.nome asc")->num_rows;
$totalPaginas = ceil($numTotal / $itensPorPagina);

$sqlCategoria = "SELECT nomeCategoria from categoriaemp ORDER BY nomeCategoria asc";
$resultadoCategoria = $mysqli->query($sqlCategoria);
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista Telefônica</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php include "include/menu.php" ?>
    <div class="container  mt-5">
        <div class="row ">
            <div class="col-lg-4">
                <!-- Search widget-->
                <div class="card mb-4 ">
                    <div class="card-header">Procurar</div>
                    <form action="lista_telefonica.php" method="GET">
                        <div class="card-body">
                            <div class="input-group">
                                <input class="form-control" list="datalistOptions" name="pesquisa"
                                    value="<?php echo isset($_GET['pesquisa']) ? htmlspecialchars($_GET['pesquisa']) : ''; ?>"
                                    placeholder="Digite para pesquisar...">
                                <datalist id="datalistOptions">
                                    <?php
                                    if ($resultadoCategoria->num_rows > 0) {
                                        while ($row = $resultadoCategoria->fetch_assoc()) {
                                            $nomeCategoria = $row["nomeCategoria"];
                                            echo "<option value=\"$nomeCategoria\">";
                                        }
                                    }
                                    ?>
                                </datalist>
                                <button class="btn btn-pesquisar" id="button-search" type="submit">Ir!</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- Categories widget-->
                <div class="card mb-4">
                    <div class="card-header">Sugestões de Categorias</div>
                    <div class="card-body">
                        <div class="row">
                            <?php
                            $sqlCategoria = "SELECT nomeCategoria FROM categoriaemp ORDER BY nomeCategoria ASC";
                            $resultadoCategoria = $mysqli->query($sqlCategoria);

                            $categorias = array();

                            if ($resultadoCategoria->num_rows > 0) {
                                while ($row = $resultadoCategoria->fetch_assoc()) {
                                    $nomeCategoria = htmlspecialchars($row["nomeCategoria"]);
                                    $categorias[] = $nomeCategoria;
                                }

                                // Embaralhe o array de categorias de forma aleatória
                              
                                  shuffle($categorias);
                                // Exiba apenas as primeiras 30 categorias do array
                                $categoriasLimitadas = array_slice($categorias, 0, 35);

                                $alternaColuna = true; // Variável para alternar entre col-sm-6
                            
                                foreach ($categoriasLimitadas as $nomeCategoria) {
                                    // Verifica se deve alternar a coluna
                                    if ($alternaColuna) {
                                        echo '<div class="col-sm-12"><ul class="list-unstyled mb-0">';
                                    } else {
                                        echo '<div class="col-sm-12"><ul class="list-unstyled mb-0">';
                                    }
                                    echo '<li><a href="lista_telefonica.php?pesquisa=' . $nomeCategoria . '">' . $nomeCategoria . '</a></li>';

                                    echo '</ul></div>';
                                    $alternaColuna = !$alternaColuna; // Inverte a alternância
                                }
                            } else {
                                echo '<li><a href="#!">Nenhuma categoria encontrada</a></li>';
                            }
                            ?>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-lg-8 ">
                <!-- Post content-->
                <article>
                    <!-- Post header-->
                    <header class="mb-4">
                        <!-- Post title-->
                        <h1 class="fw-bolder mb-1">Lista Telefônica
                        </h1>
                    </header>
                    <section class="mb-5">
                        <?php if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) { ?>
                                <div class="row mt-4">
                                    <div class="col-md-6">
                                        <img src="<?php echo $row["path_foto"] ?>" class="img-fluid" style="width:400px"
                                            alt="<?php echo $row["nome_foto"] ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <h2>
                                            <?php echo $row["nome_empresa"] ?>
                                        </h2>
                                        <p><i class="fa-solid fa-shop"></i>
                                            <?php echo $row["categoria"] ?>
                                        </p>
                                        <p><i class="fa-solid fa-location-dot"></i>
                                            <?php echo $row["rua"] ?>,
                                            <?php echo $row["numero"] ?> -
                                            <?php echo $row["bairro"] ?>,
                                            <?php echo $row["cidade"] ?> -
                                            <?php echo $row["estado"] ?>,
                                            <?php echo $row["cep"] ?>
                                        </p>
                                        <p><a href="tel:+55<?php echo $row["tel_numero"] ?>" target="_blank"
                                                rel="noopener noreferrer"><i class="fa-solid fa-phone"></i>
                                                <?php echo $row["tel_numero"] ?>
                                            </a>
                                        </p>
                                        <p><a href="http://wa.me/55<?php echo $row["wpp_numero"] ?>" target="_blank"
                                                rel="noopener noreferrer"><i class="fa-brands fa-whatsapp"></i>
                                                <?php echo $row["wpp_numero"] ?>
                                            </a>
                                        </p>
                                        <p><a href="http://instagram.com/<?php echo $row["instagram"] ?>" target="_blank"
                                                rel="noopener noreferrer"><i class="fa-brands fa-instagram"></i>
                                                instagram</a>

                                        </p>
                                    </div>
                                </div>
                            <?php }
                        } else {
                            echo "Nenhum resultado encontrado.";
                        } ?>
                    </section>
                </article>
            </div>
        </div>
    </div>
    <div class="container mt-3 text-center">
        <div class="row">
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <?php
                    $paginaAtual = $pagina;
                    $paginasExibidas = 5;
                    $meio = floor($paginasExibidas / 2);

                    // Calcula o início e o fim das páginas a serem exibidas
                    $inicio = max(0, $paginaAtual - $meio);
                    $fim = min($totalPaginas - 1, $paginaAtual + $meio);

                    // Se a página atual for maior que 2, exibe a seta "Previous"
                    if ($paginaAtual > 2) {
                        echo '<li class="page-item"><a class="page-link" href="lista_telefonica.php?pagina=0&pesquisa=' . urlencode($pesquisa) . '" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>';
                    }

                    // Exibe as páginas
                    for ($i = $inicio; $i <= $fim; $i++) {
                        $estilo = ($paginaAtual == $i) ? "active" : "";
                        echo '<li class="page-item ' . $estilo . '"><a class="page-link" href="lista_telefonica.php?pagina=' . $i . '&pesquisa=' . urlencode($pesquisa) . '">' . ($i + 1) . '</a></li>';
                    }

                    // Se a página atual estiver a menos de 2 páginas do final, exibe a seta "Next"
                    if ($paginaAtual < $totalPaginas - 3) {
                        echo '<li class="page-item"><a class="page-link" href="lista_telefonica.php?pagina=' . ($totalPaginas - 1) . '&pesquisa=' . urlencode($pesquisa) . '" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>';
                    }
                    ?>
                </ul>
            </nav>
        </div>
    </div>


    <?php include "include/footer.php" ?>
</body>

</html>