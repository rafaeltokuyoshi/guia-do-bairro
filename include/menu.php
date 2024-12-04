<nav class="navbar navbar-expand-lg navbar-light bg-light bg-azul">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand" href="#">
            <img src="assets/logo.png" alt="" height="65px">
        </a>
        <!-- Botão para dispositivos móveis -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="fa-solid fa-bars" style="color: #f7c410;"></span>
        </button>

        <!-- Itens de Navegação -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link <?php if ($page == 'index') {
                        echo 'active';
                    } ?>" href="index.php"> Início</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if ($page == 'lista') {
                        echo 'active';
                    } ?>" href="lista_telefonica.php">Estabelecimentos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if ($page == 'sobre') {
                        echo 'active';
                    } ?>" href="index.php#sobre"></i> Sobre</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if ($page == 'contato') {
                        echo 'active';
                    } ?>" href="index.php#contato"></i> Contato</a>
                </li>
            </ul>

        </div>
    </div>
</nav>