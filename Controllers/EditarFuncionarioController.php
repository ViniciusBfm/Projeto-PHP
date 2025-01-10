<?php 
namespace Controllers;

use Models\Database;

class EditarFuncionarioController
{

    public function __construct()
    {
        // Cria uma instância da view, passando o nome do arquivo de visualização
        $this->view =new \Views\MainView('editarfuncionario');
    }

    public function executar()
    {
        // Verifica se o id foi passado pela URL
        $id = $_GET['id'] ?? '';

        if (!empty($id) && is_numeric($id)) {
            
            try {
                $pdo = Database::connect();
                $stmt = $pdo->prepare("SELECT * FROM tbl_funcionario WHERE id_funcionario = ?");
                $stmt->execute([$id]);
                $funcionario = $stmt->fetch();

                if ($funcionario) {
                    // Se o funcionário for encontrado, exibe a página de edição com os dados do funcionário
                    $this->view->render(array(
                        "titulo" => "Editar Funcionário",
                        "funcionario" => $funcionario,
                    ));
                } else {
                    // Caso o funcionário não seja encontrado
                    $_SESSION['erro_editarfuncionario'] = "Funcionário não encontrado.";
                    header("Location: " . INCLUDE_PATH . "editarfuncionario");
                    exit();
                }
            } catch (Exception $e) {
                $_SESSION['erro_editarfuncionario'] = "Erro de conexão com o banco de dados: " . $e->getMessage();
                header("Location: " . INCLUDE_PATH . "editarfuncionario");
                exit();
            }
        } else {
            // Caso o ID não seja válido ou não fornecido
            $_SESSION['erro_editarfuncionario'] = "ID inválido.";
            header("Location: " . INCLUDE_PATH . "editarfuncionario");
            exit();
        }
    }
}


?>