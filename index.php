<?php
include "admin/conexao.php";
$sql = "SELECT * FROM fotos_site WHERE lugar LIKE '%banner%'";
$result = $mysqli->query($sql);
$page = "index";
$sql2 = "SELECT 
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
WHERE empresas.destaque = 'Destacado'
ORDER BY RAND()
LIMIT 3;
";

$result2 = $mysqli->query($sql2);
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/style.css">

</head>

<body>
    <?php include "include/menu.php" ?>
    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <?php
            $active = true; // Variável para controlar se a classe "active" deve ser adicionada à primeira imagem
            if ($result->num_rows > 0) {
                // Exibir os resultados
                while ($row = $result->fetch_assoc()) {
                    // Verificar se esta é a primeira imagem e adicionar a classe "active" se for
                    $class = $active ? 'active' : '';
            ?>

                    <div class="carousel-item <?php echo $class; ?>">
                        <img src="<?php echo $row["path"]; ?>" class="d-block w-100" alt="<?php echo $row["nome"]; ?>">
                    </div>
            <?php
                    // Após a primeira imagem, definir $active como falso para as próximas imagens
                    $active = false;
                }
            } else {
                echo "Nenhuma foto cadastrada.";
            }
            ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <!-- Campo de Pesquisa -->
    <br>
    <form class="d-flex justify-content-center my-2 my-lg-0" action="lista_telefonica.php" method="GET">
        <div class="input-group" style="max-width: 400px;">
            <input class="form-control" list="datalistOptions" name="pesquisa"
                value="<?php echo isset($_GET['pesquisa']) ? htmlspecialchars($_GET['pesquisa']) : ''; ?>"
                placeholder="O que deseja procurar?">
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
    </form>

    <section class="services py-5  text-white">
        <div class="container">
            <h1 class="text-center text-black mb-4 ">Estabelecimentos em destaque</h1>
            <div class="row">
                <?php if ($result2->num_rows > 0) {
                    while ($row = $result2->fetch_assoc()) { ?>
                        <div class="col-md-4">
                            <div class="card mb-4">
                                <img src="<?php echo $row["path_foto"] ?>" class="card-img-top" alt="Imagem">
                                <div class="card-body">
                                    <h2>
                                        <?php echo $row["nome_empresa"] ?>
                                    </h2>
                                    <p>
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
                                            rel="noopener noreferrer"><i class="fa-brands fa-instagram"></i> instagram</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    <?php }
                } else { ?>
                    <div class="col-md-4">
                        <div class="card mb-4">
                            <img src="img/cartao2.png" class="card-img-top" alt="Imagem">
                            <div class="card-body">
                                <h2>Anuncie!!</h2>
                                <p>Descrição</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mb-4">
                            <img src="img/cartao2.png" class="card-img-top" alt="Imagem">
                            <div class="card-body">
                                <h2>Anuncie!!</h2>
                                <p>Descrição</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mb-4">
                            <img src="img/cartao2.png" class="card-img-top" alt="Imagem">
                            <div class="card-body">
                                <h2>Anuncie!!</h2>
                                <p>Descrição</p>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>


    <section class="about-section" id="sobre">
        <div class="container">
            <div class="row">
                <div class="content-column col-lg-6 col-md-12 col-sm-12 order-2">
                    <div class="inner-column">
                        <div class="sec-title">
                            <span class="title">Sobre</span>
                            <h2 class="font-weight-bold">Guia do Bairro</h2>
                        </div>
                        <div class="text">Nosso objetivo é trazer facilidade para você encontrar todos os estabelecimentos na cidade!</div>
                        <div class="text">
                            Sem complicações e sem dificuldades. <strong>Pesquisou, ACHOUUUU!!! </strong>
                        </div>
                        <div class="btn-box">
                            <a href="#" class="theme-btn btn-style-one">Contato</a>
                        </div>
                    </div>
                </div>

                <!-- Image Column -->
                <div class="image-column col-lg-6 col-md-12 col-sm-12">
                    <div class="inner-column wow fadeInLeft">
                        <div class="author-desc">
                            <h2 >Nunca foi tão facil</h2>
                            <span>Encontrar Alguem!</span>
                        </div>
                        <figure class="image-1"><a href="#" class="lightbox-image" data-fancybox="images"><img
                                    src="assets/ftsobre.png" alt=""></a></figure>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="features py-5 mt-4">
        <div class="container text-center">
            <h1 class="font-weight-bold mb-5">Beneficios da nossa plataforma</h1>
            <div class="row">
                <div class="col-md-4">
                    <i class="fas fa-user-check fa-3x mb-3"></i>
                    <h3>Facilidade de Navegação para Idosos</h3>
                    <p>O site é desenvolvido com foco no público idoso, oferecendo uma interface simples e intuitiva para facilitar a busca por comércios locais.</p>
                </div>
                <div class="col-md-4">
                    <i class="fas fa-handshake fa-3x mb-3"></i>
                    <h3>Acesso para Todos</h3>
                    <p>Embora o foco seja o público idoso, a plataforma estará disponível para qualquer pessoa que queira encontrar comércios em sua região.</p>
                </div>
                <div class="col-md-4">
                    <i class="fas fa-comments fa-3x mb-3"></i>
                    <h3>Informações Essenciais dos Estabelecimentos</h3>
                    <p>Cada comércio listado inclui nome, foto, telefone de contato e endereço completo com mapa para facilitar a localização.</p>
                </div>
            </div>
        </div>
    </section>
    </br></br></br></br></br>
    <section class="contact-page-sec">
        <div class="container">
            <h1 class="text-center text-black mb-4">Podemos te ajudar ?</h1>
            <div class="container text-center">
                <div class="row">
                    <div class="col-md-2">
                    </div>
                    <div class="col-md-8">
                        <p class="text-center">Entre em contato via formulário, e-mail ou telefone para obter todas as informações necessárias. Estamos à disposição para ajudar e fornecer todos os detalhes que você precisa. </p>
                    </div>
                    <div class="col-md-2">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="contact-page-form" method="post">
                        <h2>Contato!</h2>
                        <form action="contatomail.php" method="post">
                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="single-input-field">
                                        <input type="text" placeholder="Nome" name="name" />
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="single-input-field">
                                        <input type="email" placeholder="E-mail" name="email" required />
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="single-input-field">
                                        <input type="text" placeholder="Numero de telefone" name="phone" />
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="single-input-field">
                                        <input type="text" placeholder="Objetivo" name="objetivo" />
                                    </div>
                                </div>
                                <div class="col-md-12 message-input">
                                    <div class="single-input-field">
                                        <textarea placeholder="Descreva o motivo do contato"
                                            name="descricao"></textarea>
                                    </div>
                                </div>
                                <div class="btn-box">
                                    <a href="#" class="theme-btn btn-style-one">Enviar</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="contact-page-map">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d12503.473692000132!2d-47.48971274019112!3d-23.475093559736102!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94c5f54bcad87989%3A0x4a9099fb9d10cb8e!2sSorocaba%2C%20SP!5e1!3m2!1spt-BR!2sbr!4v1729036246806!5m2!1spt-BR!2sbr"
                            width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="contact-info">
                        <div class="contact-info-item">
                            <div class="contact-info-icon">
                                <i class="fas fa-map-marked"></i>
                            </div>
                            <div class="contact-info-text">
                                <h2>Localização</h2>
                                <span>Sorocaba - SP</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="contact-info">
                        <div class="contact-info-item">
                            <div class="contact-info-icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="contact-info-text">
                                <h2>E-mail</h2>
                                <span>contato@guiadobairro.com.br</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="contact-info">
                        <div class="contact-info-item">
                            <div class="contact-info-icon">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="contact-info-text">
                                <h2>Horário de atendimento</h2>
                                <span>Seg - Sex 9:00 - 17:00</span>
                                <span>Sab 09:00 - 12:00</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    </br></br></br></br>
    <?php include "include/footer.php" ?>


</body>

</html>