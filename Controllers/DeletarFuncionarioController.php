<?php 
namespace Controllers;

use Models\Database;

class DeletarFuncionarioController extends Controller
{
    public function __construct() {
        // Nenhum header ou footer específico para este controlador
    }

    public function executar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Inicia a sessão, se não estiver iniciada
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            // Verifica se o usuário está logado
            if (!isset($_SESSION['usuario_logado'])) {
                header('Location: ' . INCLUDE_PATH . 'login');
                exit();
            }

            if (isset($_POST['action']) && $_POST['action'] === 'excluir' && isset($_POST['id'])) {
                $id = $_POST['id'] ?? '';
                try {
                    // Conecta ao banco de dados
                    $pdo = Database::connect();
                    
                    // Prepara a instrução SQL para excluir o funcionário
                    $stmt = $pdo->prepare("DELETE FROM tbl_funcionario WHERE id_funcionario = ?");
                    
                    // Executa a exclusão
                    if ($stmt->execute([$id])) {
                        $_SESSION['sucesso_excluirfuncionario'] = "Funcionário N° $id excluído com sucesso!";
                    } else {
                        $_SESSION['erro_excluirfuncionario'] = "Erro ao excluir o funcionário.";
                    }
                } catch (\PDOException $e) {
                    $_SESSION['erro_excluirfuncionario'] = "Erro de conexão com o banco de dados: " . $e->getMessage();
                }
            } else {
                $_SESSION['erro_excluirfuncionario'] = "ID inválido.";
            }

            
            header('Location: ' . INCLUDE_PATH . 'home');
            exit();
        }
    }
}

?>