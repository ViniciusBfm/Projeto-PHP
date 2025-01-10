<?php 
namespace Controllers;

use Models\Database;

class CadastrarFuncionariosController {
    
    public function __construct() {
        $this->view = new \Views\MainView('cadastrarfuncionarios');
    }
    
    public function executar() {
        // Inicializa as variáveis com valores vazios para evitar erros de "undefined index"
        $nome = $cpf = $rg = $email = $setor = $salario = $bonificacao = $id_empresa = '';

        // Busca os IDs e os nomes das empresas no banco de dados
        try {
            $pdo = Database::connect();
            $stmt = $pdo->query("SELECT id_empresa, nome FROM tbl_empresa");
            $empresas = $stmt->fetchAll(\PDO::FETCH_ASSOC); // Obtém id e nome das empresas
        } catch (\PDOException $e) {
            $empresas = [];
        }
        
        /// Verifica se o formulário foi enviado
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Obtém os dados do formulário
            $nome = $_POST['nome'] ?? '';
            $cpf = $_POST['cpf'] ?? '';
            $rg = $_POST['rg'] ?? '';
            $email = $_POST['email'] ?? '';
            $salario = $_POST['salario'] ?? '';
            $id_empresa = $_POST['id_empresa'] ?? ''; // Recebe o ID da empresa selecionada
            $data = date('Y-m-d'); // Data atual
            $bonificacao = 0; // Inicia a bonificação como 0
            
            // Limpar CPF e RG, removendo os pontos e traços
            $cpf = preg_replace('/\D/', '', $cpf); // Remove tudo o que não for número
            $rg = preg_replace('/\D/', '', $rg); // Remove tudo o que não for número
            
            // Limpar os valores de salário
            $salario = (float)str_replace(['R$', '.', ','], ['', '', '.'], $salario);
            
            // Verifica se todos os dados obrigatórios foram preenchidos
            if (!empty($nome) && !empty($cpf) && !empty($rg) && !empty($email) && !empty($salario)) {
                
                // Capitaliza o nome antes de salvar
                $nome = ucwords(strtolower(trim($nome)));
                              
                $pdo = Database::connect();
                
                // Verifica se o email já está registrado
                $stmt = $pdo->prepare("SELECT * FROM tbl_funcionario WHERE email = ?");
                $stmt->execute([$email]);
                
                if ($stmt->rowCount() > 0) {
                    $_SESSION['erro_email'] = "Este email já está registrado.";
                } else {
                     
                    // Insere o novo funcionário no banco de dados
                    $stmt = $pdo->prepare("INSERT INTO tbl_funcionario (nome, cpf, rg, email, salario, bonificacao, data_cadastro, id_empresa) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                    
                    if ($stmt->execute([$nome, $cpf, $rg, $email, $salario, $bonificacao, $data, $id_empresa])) {
                        $_SESSION['sucesso_cadastrarfuncionario'] = "Funcionário cadastrado com sucesso!";
                        header("Location: " . INCLUDE_PATH . "cadastrarfuncionarios");
                        exit();
                    } else {
                        $_SESSION['erro_cadastrarfuncionario'] = "Erro ao cadastrar. Tente novamente.";
                    }
                }
            } else {
        $_SESSION['erro_cadastrarfuncionario'] = "Por favor, preencha todos os campos.";
    }
}


        
        
        
    
        // Passa as funções e possíveis mensagens de erro para a view
        $erro_cadastrarfuncionario = $_SESSION['erro_cadastrarfuncionario'] ?? null;
        unset($_SESSION['erro_cadastrarfuncionario']); // Limpa a mensagem após exibição
    
        // Renderiza a view, passando as variáveis
        $this->view->render(array(
            "titulo" => "Cadastrar Funcionários",
            "erro_cadastrarfuncionario" => $erro_cadastrarfuncionario,
            "nome" => $nome,
            "cpf" => $cpf,
            "rg" => $rg,
            "email" => $email,
            "setor" => $setor,
            "salario" => $salario,
            "bonificacao" => $bonificacao,
            "empresas" => $empresas
        ));
    }
}

?>