<?php
namespace Controllers;

use Models\Database;

class AtualizarFuncionarioController
{
    public function executar()
    {
        // Verifica se o método é POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Obtém os dados enviados pelo formulário
            $id = $_POST['id'] ?? '';
            $nome = $_POST['nome'] ?? '';
            $cpf = $_POST['cpf'] ?? '';
            $rg = $_POST['rg'] ?? '';
            $email = $_POST['email'] ?? '';
            $salario = $_POST['salario'] ?? '';
            $bonificacao = $_POST['bonificacao'] ?? '';

            // Remove pontos e vírgulas do salário e bonificação para salvar no banco corretamente
            $salario = str_replace(['.', ','], ['', '.'], $salario);
            $bonificacao = str_replace(['.', ','], ['', '.'], $bonificacao);

            // Verifica se todos os campos obrigatórios foram preenchidos
            if (!empty($id) && !empty($nome) && !empty($cpf) && !empty($rg) && !empty($email) && !empty($salario) && !empty($bonificacao)) {
                // Conecta ao banco de dados
                $pdo = Database::connect();

                try {
                    // Atualiza os dados do funcionário no banco de dados
                    $stmt = $pdo->prepare("
                        UPDATE tbl_funcionario 
                        SET nome = ?, cpf = ?, rg = ?, email = ?, salario = ?, bonificacao = ? 
                        WHERE id_funcionario = ?
                    ");
                    $stmt->execute([$nome, $cpf, $rg, $email, $salario, $bonificacao, $id]);

                    // Redireciona para a página inicial com uma mensagem de sucesso
                    header('Location: ' . INCLUDE_PATH . 'home?sucesso=1');
                    exit();
                } catch (\PDOException $e) {
                    // Mostra uma mensagem de erro caso a atualização falhe
                    echo "Erro ao atualizar o funcionário: " . $e->getMessage();
                }
            } else {
                echo "Preencha todos os campos obrigatórios.";
            }
        } else {
            echo "Método de requisição inválido.";
        }
    }
}
?>