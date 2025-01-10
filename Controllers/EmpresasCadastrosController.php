<?php 
namespace Controllers;

use Models\Database;

class EmpresasCadastrosController
{
    private $mensagem;

    public function __construct()
    {
        $this->view = new \Views\MainView('empresascadastros');
        $this->mensagem = '';
    }

    public function executar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = $_POST['nome'] ?? '';

            if (!empty($nome)) {
                try {
                    $pdo = Database::connect();
                    $stmt = $pdo->prepare("INSERT INTO tbl_empresa (nome) VALUES (?)");
                    $stmt->execute([$nome]);

                    $this->mensagem = "Empresa cadastrada com sucesso!";
                } catch (\PDOException $e) {
                    $this->mensagem = "Erro ao cadastrar a empresa: " . $e->getMessage();
                }
            } else {
                $this->mensagem = "O nome da empresa é obrigatório.";
            }
        }

        $this->view->render(array(
            "titulo" => "empresascadastros",
            "mensagem" => $this->mensagem
        ));
    }
}
?>