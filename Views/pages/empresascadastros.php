<div class="main-content">
    <main class="menu-infos">
        <div id="solicitacao" class="cadastrar">
            <div class="solicitacao-container">
                <div class="titulo">
                    <div>
                        <h1>Empresa</h1>
                    </div>
                </div>
                <div class="solicitar-container">
                    <div class="solicitar-box visualizarbtn" href="#aprovadassolicitacoes">
                        <div>
                            <h3>Cadastrar empresa</h3>
                            <p style="color: black;">Faça o cadastro agora mesmo!</p>
                        </div>
                        <img src="<?= INCLUDE_IMAGES; ?>/mais.png" alt="add">
                    </div>
                </div>
                <div class="solicitacao-box">
                    <div class="solicitar-form">
                        <div id="infos2-solicitacao" class="infos2">
                            <div id="solicitar" class="conteudo2 ">
                                <form action="<?= INCLUDE_PATH . 'empresaScadastros'; ?>" method="post">
                                    <div class="solicitar-paginas" style="display: flex; flex-direction: column">
                                        <p>Nome da empresa:</p>
                                        <input type="text" name="nome" required placeholder="Ex: Empresa MyPHP">
                                    </div>
                                    <input type="submit" value="Cadastrar">
                                </form>
                            </div>
                            <?php if (!empty($mensagem)): ?>
                            <div class="alert alert-info">
                                <?= htmlspecialchars($mensagem, ENT_QUOTES, 'UTF-8'); ?>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>