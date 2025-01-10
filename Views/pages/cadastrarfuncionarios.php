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
                    <div class="solicitar-box visualizarbtn" href="#aprovadassolicitacoes">
                        <div>
                            <h3>Cadastrar funcionários</h3>
                            <p style="color: black;">Faça o cadastro agora mesmo!</p>
                        </div>
                        <img src="<?= INCLUDE_IMAGES; ?>/mais.png" alt="add">
                    </div>
                </div>
                <div class="solicitacao-box">
                    <div class="solicitar-form">
                        <div id="infos2-solicitacao" class="infos2">
                            <div id="solicitar" class="conteudo2 ">
                                <form action="" method="post">
                                    <div class="solicitar-paginas" style="display: flex; flex-direction: column">
                                        <p>Nome:</p>
                                        <input type="text" name="nome" required
                                            placeholder="Ex: Vinicius Braz Ferreira Mendes">
                                    </div>
                                    <div class="solicitar-paginas">
                                        <div>
                                            <p>CPF:</p>
                                            <input type="text" name="cpf" id="cpf" required
                                                placeholder="Ex: 123.456.789-00">
                                        </div>
                                        <div>
                                            <p>RG:</p>
                                            <input type="text" name="rg" id="rg" required
                                                placeholder="Ex: 12.345.678-9">
                                        </div>
                                    </div>
                                    <div class="solicitar-paginas">
                                        <div>
                                            <p>E-mail:</p>
                                            <input type="email" name="email" required
                                                placeholder="Ex: usuario@dominio.com">
                                        </div>
                                        <div>
                                            <p>Empresa:</p>
                                            <select name="id_empresa" required>
                                                <option value="" disabled selected>Selecione uma empresa</option>
                                                <?php if (!empty($empresas)): ?>
                                                <?php foreach ($empresas as $empresa): ?>
                                                <option
                                                    value="<?= htmlspecialchars($empresa['id_empresa'], ENT_QUOTES, 'UTF-8'); ?>">
                                                    <?= htmlspecialchars($empresa['nome'], ENT_QUOTES, 'UTF-8'); ?>
                                                </option>
                                                <?php endforeach; ?>
                                                <?php else: ?>
                                                <option value="" disabled>Nenhuma empresa cadastrada</option>
                                                <?php endif; ?>
                                            </select>
                                        </div>


                                    </div>
                                    <div class="solicitar-paginas">
                                        <div>
                                            <p>Salário:</p>
                                            <input type="text" name="salario" id="salario" required
                                                placeholder="Ex: R$ 1.500,00">
                                        </div>
                                        <div>
                                            <p>Bonificação:</p>
                                            <input type="text" name="bonificacao" id="bonificacao" value="Calculando..."
                                                disabled>
                                        </div>

                                    </div>
                                    <input type="submit" value="Cadastrar">
                                </form>
                                <?php
                                if (isset($_SESSION['erro_email'])) {
                                    echo '<div class="alert alert-danger" role="alert">' . $_SESSION['erro_email'] . '</div>';
                                    unset($_SESSION['erro_email']); // Limpa a mensagem após exibir
                                }

                                if (isset($_SESSION['erro_cadastrarfuncionario'])) {
                                    echo '<div class="alert alert-danger" role="alert">' . $_SESSION['erro_cadastrarfuncionario'] . '</div>';
                                    unset($_SESSION['erro_cadastrarfuncionario']); // Limpa a mensagem após exibir
                                }
                                ?>

                                <!-- Exibe a mensagem de sucesso -->
                                <?php
                                if (isset($_SESSION['sucesso_cadastrarfuncionario'])) {
                                    echo '<div class="alert alert-success" role="alert">' . $_SESSION['sucesso_cadastrarfuncionario'] . '</div>';
                                    unset($_SESSION['sucesso_cadastrarfuncionario']); // Limpa a mensagem após exibir
                                }
                                ?>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
<script>
//CPF os pontos e traços
document.getElementById('cpf').addEventListener('input', function(e) {
    let value = e.target.value;

    // Remove tudo o que não for número
    value = value.replace(/\D/g, '');

    // Aplica a máscara do CPF: 000.000.000-00
    value = value.replace(/(\d{3})(\d)/, '$1.$2'); // Adiciona o primeiro ponto
    value = value.replace(/(\d{3})(\d)/, '$1.$2'); // Adiciona o segundo ponto
    value = value.replace(/(\d{3})(\d{1,2})$/, '$1-$2'); // Adiciona o traço

    // Atualiza o valor no campo de entrada
    e.target.value = value;
});
//RG os pontos
document.getElementById('rg').addEventListener('input', function(e) {
    let value = e.target.value;

    // Remove tudo o que não for número
    value = value.replace(/\D/g, '');

    // Aplica a máscara do RG: 00.000.000-0
    value = value.replace(/(\d{2})(\d)/, '$1.$2'); // Adiciona o primeiro ponto
    value = value.replace(/(\d{3})(\d)/, '$1.$2'); // Adiciona o segundo ponto
    value = value.replace(/(\d{3})(\d{1})$/, '$1-$2'); // Adiciona o traço

    // Atualiza o valor no campo de entrada
    e.target.value = value;
});
// Função para formatar campos de moeda de bonificação e salário
function formatCurrency(input) {
    input.addEventListener('input', function(e) {
        let value = e.target.value;

        // Remove o "R$" inicial para evitar duplicação ao reformatar
        value = value.replace(/^R\$\s?/, '');

        // Remove tudo que não for número
        value = value.replace(/\D/g, '');

        // Adiciona os pontos e a vírgula
        value = value.replace(/(\d)(\d{2})$/, '$1,$2'); // Adiciona a vírgula antes dos últimos 2 dígitos
        value = value.replace(/(?=(\d{3})+(\D))\B/g, '.'); // Adiciona os pontos nos milhares

        // Atualiza o valor no input com "R$"
        e.target.value = value ? `R$ ${value}` : '';
    });
}

// Aplica a função para os campos de Salário e Bonificação
formatCurrency(document.getElementById('salario'));
formatCurrency(document.getElementById('bonificacao'));
</script>