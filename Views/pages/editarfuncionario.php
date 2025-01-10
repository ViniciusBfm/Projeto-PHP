<div class="main-content">
    <main class="menu-infos">
        <div id="solicitacao" class="cadastrar">
            <div class="solicitacao-container">
                <div class="titulo">
                </div>
                <div class="solicitar-container">
                    <div class="solicitar-box visualizarbtn" href="#aprovadassolicitacoes">
                        <div>
                            <h3>Alterar informações</h3>
                            <p style="color: black; font-weight: 600"><?= $funcionario['nome']; ?></p>
                        </div>
                    </div>
                </div>
                <div class="solicitacao-box">
                    <div class="solicitar-form">
                        <div id="infos2-solicitacao" class="infos2">
                            <div id="solicitar" class="conteudo2 ">

                                <form action="<?= INCLUDE_PATH . 'atualizarfuncionario'; ?>" method="POST"
                                    class="form-alterar">
                                    <input type="hidden" name="id" value="<?= $funcionario['id_funcionario']; ?>">

                                    <div>
                                        Alterar as informações do funcionário
                                    </div>

                                    <div class="solicitar-paginas">
                                        <div style="width: 100%;">
                                            <label for="nome" class="form-label">Nome:</label>
                                            <input type="text" class="form-control" name="nome"
                                                value="<?= $funcionario['nome']; ?>" required>
                                        </div>
                                    </div>

                                    <div>
                                        <label for="email" class="form-label">Email:</label>
                                        <input type="email" class="form-control" name="email"
                                            value="<?= $funcionario['email']; ?>" required>
                                    </div>

                                    <div>
                                        <label for="cpf" class="form-label">CPF:</label>
                                        <input type="text" class="form-control" name="cpf"
                                            value="<?= $funcionario['cpf']; ?>" required>
                                    </div>

                                    <div>
                                        <label for="rg" class="form-label">RG:</label>
                                        <input type="text" class="form-control" name="rg"
                                            value="<?= $funcionario['rg']; ?>" required>
                                    </div>

                                    <div>
                                        <label for="salario" class="form-label">Salário:</label>
                                        <input type="text" class="form-control" name="salario"
                                            value="<?= number_format($funcionario['salario'], 2, ',', '.'); ?>"
                                            required>
                                    </div>

                                    <div style="display: none;">
                                        <label for="bonificacao" class="form-label">Bonificação:</label>
                                        <input type="text" class="form-control" name="bonificacao"
                                            value="<?= number_format($funcionario['bonificacao'], 2, ',', '.'); ?>"
                                            required>
                                    </div>

                                    <div>
                                        <label for="data_cadastro" class="form-label">Data de Cadastro:</label>
                                        <input type="text" class="form-control" name="data_cadastro"
                                            value="<?= date('d/m/Y', strtotime($funcionario['data_cadastro'])); ?>"
                                            readonly>
                                    </div>

                                    <div class="modal-footer">
                                        <form action="<?= INCLUDE_PATH;?>home" method="get">
                                            <button type="submit" class="btn btn-secondary mx-4">Voltar</button>
                                        </form>
                                        <button type="submit" class="btn btn-primary">Salvar alterações</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>