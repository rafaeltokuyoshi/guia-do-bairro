<?php
// Inclua a conexão com o banco de dados e qualquer lógica de verificação de sessão, se necessário
include('../conexao.php');
include('../protect.php');
$sql_code = "SELECT * FROM categoriaemp ORDER BY nomeCategoria ASC";
$sql_query = $mysqli->query($sql_code) or die($mysqli->error);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Certifique-se de validar e filtrar o ID da empresa recebido via POST
    $id_empresas = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

    // Consulta SQL para obter os dados da empresa com base no ID
    $sql = "SELECT 
    empresas.id_empresas,
    empresas.nome AS nome_empresa,
    empresas.tel_numero,
    empresas.wpp_numero,
    empresas.instagram,
    empresas.facebook,
    empresas.categoria,
    empresas.destaque,
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
LEFT JOIN fotos_empresas ON empresas.id_empresas = fotos_empresas.id_empresas WHERE empresas.id_empresas = $id_empresas";
    $result = $mysqli->query($sql);

    if ($result->num_rows > 0) {
        $empresa = $result->fetch_assoc(); ?>
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Editar Empresa</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="editForm" action="include/editEmpresa.php" enctype="multipart/form-data" method="post">
            <div class="modal-body">

                <input type="hidden" name="id" value="<?php echo $empresa['id_empresas']; ?>">
                <div class="row">
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label class="form-label">Nome da Empresa</label>
                            <input type="text" class="form-control" name="nomeEmpresa" id="nomeEmpresa"
                                value="<?php echo $empresa['nome_empresa']; ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Categoria</label>
                            <select class="form-select" name="categoria" aria-label="categoria">
                                <option value="<?php echo $empresa['categoria']; ?>">
                                    <?php echo $empresa['categoria']; ?>
                                </option>
                                <?php while ($categoria = $sql_query->fetch_assoc()) { ?>
                                    <option value="<?php echo $categoria['nomeCategoria'] ?>">
                                        <?php echo $categoria['nomeCategoria'] ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>

                    </div>

                </div>
                <div class="row">
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label class="form-label">Endereço</label>
                            <input type="text" class="form-control" name="rua" id="rua" value="<?php echo $empresa['rua']; ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Número</label>
                            <input type="text" class="form-control" name="numero" id="numero"
                                value="<?php echo $empresa['numero']; ?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label class="form-label">Bairro</label>
                            <input type="text" class="form-control" name="bairro" id="bairro"
                                value="<?php echo $empresa['bairro']; ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Estado</label>
                            <input type="text" class="form-control" name="estado" id="estado"
                                value="<?php echo $empresa['estado']; ?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Cidade</label>
                            <input type="text" class="form-control" name="cidade" id="cidade"
                                value="<?php echo $empresa['cidade']; ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Complemento</label>
                            <input type="text" class="form-control" name="complemento" id="complemento"
                                value="<?php echo $empresa['complemento']; ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">CEP</label>
                            <input type="text" class="form-control" name="cep" id="cep" value="<?php echo $empresa['cep']; ?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Telefone</label>
                            <input type="text" class="form-control" name="telNumero" id="telNumero"
                                value="<?php echo $empresa['tel_numero']; ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">WhatsApp</label>
                            <input type="text" class="form-control" name="wppNumero" id="wppNumero"
                                value="<?php echo $empresa['wpp_numero']; ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Mural de destaque</label>
                        <select class="form-select" name="destaque" aria-label="Default select example">
                            <option value="<?php echo $empresa['destaque']; ?>">
                                <?php echo $empresa['destaque']; ?>
                            </option>
                            <option value="Comum">Comum</option>
                            <option value="Destacado">Destacado</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Instagram</label>
                            <input type="text" class="form-control" name="instagram" id="instagram"
                                value="<?php echo $empresa['instagram']; ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Facebook</label>
                            <input type="text" class="form-control" name="facebook" id="facebook"
                                value="<?php echo $empresa['facebook']; ?>">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="novaImagem">Nova Imagem:</label>
                    <input type="file" class="form-control" id="novaImagem" name="novaImagem">
                    <small class="text-muted">Selecione uma nova imagem, caso queira substituir a imagem
                        atual.</small>
                </div>

            </div>
            <div class="modal-footer">
                <a type="button" class="btn btn-secondary" href="cadTipoEmpresa.php">Fechar</a>
                <button type="submit" class="btn btn-primary" id="saveEdit">Salvar</button>
            </div>
        </form>
        <?php
    } else {
        echo 'Empresa não encontrada.';
    }
} else {
    echo 'Requisição inválida.';
}
?>