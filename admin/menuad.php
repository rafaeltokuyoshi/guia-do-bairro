    <?php include('protect.php'); ?>
    <div class=" d-flex flex-column flex-shrink-0 p-3 text-bg-dark fixed-menu">
        <a href="#" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
            <span class="fs-4 ml-3"><i class="fa-solid fa-gear fa-spin fa-lg"></i> Painel ADM</span>
        </a>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
                <a href="painel.php" class="nav-link text-white <?php if ($page=='painel'){echo 'active';} ?>" aria-current="page"><i class="fa-solid fa-house"></i> Início</a>
            </li>         
            <li>
                <a href="cadTipoEmpresa.php" class="nav-link text-white <?php if ($page=='cadTipoEmpresa'){echo 'active';} ?>"><i class="fa-solid fa-list"></i> Categoria</a>
            </li>
            <li>
                <a href="cadBanner.php" class="nav-link text-white <?php if ($page=='cadBanner'){echo 'active';} ?>"><i class="fa-solid fa-image"></i> Banner</a>
            </li>
            <li class="mb-1">
                <button class="nav-link  text-white collapsed"
                    data-bs-toggle="collapse" data-bs-target="#orders-collapse" aria-expanded="false">
                    Empresas <i class="fa-solid fa-arrow-down"></i> 
                </button>
                <div class="collapse <?php if ($page =='cadEmpresa' || $page =='empresa'){echo 'show';} ?>" id="orders-collapse">
                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li>
                        <a href="cadEmpresa.php"  class="nav-link text-white <?php if ($page=='cadEmpresa'){echo 'active';} ?>"><i class="fa-solid fa-building"></i> Cadastro</a>
                    </li>
                    <li>
                        <a href="Empresa.php"  class="nav-link text-white <?php if ($page=='empresa'){echo 'active';} ?>"><i class="fa-solid fa-building"></i> Consulta</a>
                    </li>                     
                    </ul>
                </div>
            </li>
        </ul>
        <hr>
        <div class="dropdown">
            <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                data-bs-toggle="dropdown" aria-expanded="false">
                <img src="../img/user.png" alt="" width="32" height="32" class="rounded-circle me-2">
                <strong>
                    <?php echo $_SESSION['nome']; ?>
                </strong>
            </a>
            <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                <li><a class="dropdown-item <?php if ($page=='perfil'){echo 'active';} ?>" href="perfil.php">Trocar Senha</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="logout.php">Sair</a></li>
            </ul>
        </div>
    </div>