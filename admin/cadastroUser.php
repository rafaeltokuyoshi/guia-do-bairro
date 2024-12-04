<!DOCTYPE html>
<html lang="pt-BR">

<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Administrador </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="../js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-10 col-xl-9 mx-auto">
                <div class="card flex-row my-5 border-0 shadow rounded-3 overflow-hidden">
                    <div class="card-img-left d-none d-md-flex">
                        <!-- Background image CSS -->
                    </div>
                    <div class="card-body p-4 p-sm-5">
                        <h5 class="card-title text-center mb-5 fw-light fs-5">Cadastrar</h5>
                        <form method="post" action="acCadastroUser.php">

                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" required name="nome" placeholder="Nome">
                                <label>Nome</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" required name="sobrenome" placeholder="Sobrenome">
                                <label>Sobrenome</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" required name="email" placeholder="nome@examplo.com">
                                <label>Email</label>
                            </div>

                            <hr>

                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" required name="senha" placeholder="Password">
                                <label>Senha</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" required name="senhaconfirm" placeholder="Confirm Password">
                                <label>Confirmar senha</label>
                            </div>

                            <div class="d-grid mb-2">
                                <button class="btn btn-lg btn-primary btn-login fw-bold text-uppercase" type="submit">Cadastrar</button>
                            </div>

                            <a class="d-block text-center mt-2 small" href="login.php">Já tem uma conta? Faça login</a>

                            <hr class="my-4">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>


</html>