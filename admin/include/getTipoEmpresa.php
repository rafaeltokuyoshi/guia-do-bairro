<?php
// Inclua a conexão com o banco de dados e qualquer lógica de verificação de sessão, se necessário
include('../conexao.php');
include('../protect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Certifique-se de validar e filtrar o ID da categoria recebido via POST
    $categoriaId = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

    // Consulta SQL para obter os dados da categoria com base no ID
    $sql = "SELECT * FROM categoriaemp WHERE id_categoria = $categoriaId";
    $result = $mysqli->query($sql);

    if ($result->num_rows > 0) {
        $categoria = $result->fetch_assoc(); ?>
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Cadastro de Categoria</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="editForm" action="include/editTipoEmpresa.php" method="post">
            <div class="modal-body">

                <input type="hidden" name="id_categoria" value=" <?php echo $categoria['id_categoria'] ?> ">
                <div class="mb-3">
                    <label class="form-label">Nome</label>
                    <input type="text" class="form-control" name="nomeCategoria" id="nomeCategoria"
                        value=" <?php echo $categoria['nomeCategoria'] ?>">

                </div>

            </div>
            <div class="modal-footer">
                <a type="button" class="btn btn-secondary" href="cadTipoEmpresa.php">Fechar</a>
                <button type="submit" class="btn btn-primary" id="saveEdit">Salvar</button>

            </div>
        </form>

        <?php
    } else {
        echo 'Categoria não encontrada.';
    }
} else {
    echo 'Requisição inválida.';
}
?>