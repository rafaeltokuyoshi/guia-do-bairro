<footer class="bg-azul text-white p-5">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <img src="assets/logo.png" alt="Logo" class="img-fluid mb-3" style="max-width: 150px;">
            </div>
            <div class="col-md-4">
                <ul class="list-unstyled ">
                    <li class="nav-item">
                        <a class="nav-link <?php if ($page == 'index') {
                            echo 'active';
                        } ?>" href="index.php">Início</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if ($page == 'lista') {
                            echo 'active';
                        } ?>" href="lista_telefonica.php">Lista Telefónica</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link  <?php if ($page == 'sobre') {
                            echo 'active';
                        } ?>" href="index.php#sobre"> Sobre</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if ($page == 'contato') {
                            echo 'active';
                        } ?>" href="index.php#contato">Contato</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-4 ">
                <h3>Entre em Contato</h3>
                <address>
                    <p class=""><i class="fa-solid fa-phone"></i> (15) 12344-5678</p>
                    <p class=""><i class="fa-brands fa-whatsapp"></i> (15) 12344-5678</p>
                    <p class=""><i class="fa-brands fa-instagram"></i> Guia do Bairro</p>
                    <p><i class="fa-solid fa-paper-plane"></i> <a class="text-white" href="mailto:contato@guiadobairro.com.br">contato@guiadobairro.com.br</a>
                    </p>
                </address>
            </div>
        </div>
        <span class="mt-2 text-secondary small text-white">&copy; 2024 Todos os direitos reservados</span>
    </div>
</footer>