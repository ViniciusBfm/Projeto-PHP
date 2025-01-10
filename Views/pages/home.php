<div class="main-content">
    <main class="menu-infos">
        <div id="solicitacao" class="cadastrar">
            <div class="solicitacao-container">
                <div class="titulo">
                    <div>
                        <h1>Funcionários</h1>
                    </div>
                </div>
                <div class="solicitar-container">
                    <div class="solicitar-box cadastrarbtn">
                        <div>
                            <h3>Funcionários cadastrados</h3>
                            <form action="gerar-pdf" method="POST">
                                <button type="submit" class="btn">Gerar PDF, <strong>clique aqui!</strong></button>
                            </form>
                        </div>
                        <img src="<?= INCLUDE_IMAGES; ?>/funcionarios-cadastrados.png" alt="funcionários cadastrados">
                    </div>
                </div>
                <div class="solicitacao-box">
                    <div class="solicitar-form">
                        <div id="infos2-solicitacao" class="infos2">
                            <div id="solicitar" class="conteudo2 " style="overflow: scroll;">
                                <div id="aprovadassolicitacoes" class="visualizar-cadastros">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th class="ellipsis">Nome</th>
                                                <th class="ellipsis">CPF</th>
                                                <th class="ellipsis">RG</th>
                                                <th class="ellipsis">Email</th>
                                                <th class="ellipsis">Salário</th>
                                                <th class="ellipsis">Bonificação</th>
                                                <th class="ellipsis">Data</th>
                                                <th class="ellipsis">Empresa</th>
                                                <th class="ellipsis">Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($funcionarios as $funcionario): ?>
                                            <tr class="<?php echo $funcionario['classe_linha']; ?>">
                                                <td class="ellipsis">
                                                    <?php echo htmlspecialchars($funcionario['nome']); ?></td>
                                                <td class="ellipsis">
                                                    <?php echo htmlspecialchars($funcionario['cpf']); ?></td>
                                                <td class="ellipsis"><?php echo htmlspecialchars($funcionario['rg']); ?>
                                                </td class="ellipsis">
                                                <td class="ellipsis">
                                                    <?php echo htmlspecialchars($funcionario['email']); ?></td>
                                                <td class="ellipsis">R$
                                                    <?php echo number_format($funcionario['salario'], 2, ',', '.'); ?>
                                                </td class="ellipsis">
                                                <td class="ellipsis">R$
                                                    <?php echo number_format($funcionario['bonificacao'], 2, ',', '.'); ?>
                                                </td>
                                                <td class="ellipsis">
                                                    <?php 
                                                    $data = DateTime::createFromFormat('Y-m-d', $funcionario['data_cadastro']);
                                                    echo $data ? $data->format('d/m/Y') : ''; 
                                                    ?>
                                                </td>

                                                <td class="ellipsis">
                                                    <?php echo htmlspecialchars($funcionario['nome_empresa']); ?></td>
                                                <td>
                                                    <div class="acoes-container">
                                                        <!-- Botão de Editar -->
                                                        <a href="<?php echo INCLUDE_PATH; ?>editarfuncionario?id=<?php echo $funcionario['id_funcionario']; ?>"
                                                            class="my-1">
                                                            <img src="<?php echo INCLUDE_IMAGES; ?>/editar.png"
                                                                alt="Editar">
                                                        </a>
                                                        <!-- Botão de Excluir -->
                                                        <form action="<?php echo INCLUDE_PATH; ?>deletarfuncionario"
                                                            method="POST" style="display: inline-block;">
                                                            <input type="hidden" name="id"
                                                                value="<?php echo $funcionario['id_funcionario']; ?>">
                                                            <input type="hidden" name="action" value="excluir">
                                                            <button type="submit" class="my-1">
                                                                <img src="<?php echo INCLUDE_IMAGES; ?>/excluir.png"
                                                                    alt="Excluir">
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
<script>
const cadastrarbtn = document.querySelector(".cadastrarbtn")
const visualizarbtn = document.querySelector(".visualizarbtn")

const containercadastro = document.querySelector(".solicitar-form")
const containervisualizar = document.querySelector(".visualizar-cadastros")

visualizarbtn.addEventListener("click", () => {
    containervisualizar.style.display = "none"
    containercadastro.style.display = "flex"
})
cadastrarbtn.addEventListener("click", () => {
    containercadastro.style.display = "none"
    containervisualizar.style.display = "block"
})
</script>