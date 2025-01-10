<?php
namespace Controllers;

use Models\Database; 

class HomeController {
    
    private $view;

    public function __construct(){
        $this->view = new \Views\MainView('home');
    }

    public function executar(){
        try {
            $pdo = Database::connect();
            
            // Consulta SQL para buscar todos os registros da tabela tbl_funcionario e o nome da empresa
            $sql = "
                SELECT f.*, e.nome AS nome_empresa 
                FROM tbl_funcionario f
                JOIN tbl_empresa e ON f.id_empresa = e.id_empresa
            ";
    
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
    
            $funcionarios = $stmt->fetchAll(\PDO::FETCH_ASSOC);
    
            
            foreach ($funcionarios as &$funcionario) {
                $dataAdmissao = new \DateTime($funcionario['data_cadastro']);
                $hoje = new \DateTime();
                $tempoServico = $hoje->diff($dataAdmissao)->y; 
    
                // Calcular bonificação
                if ($tempoServico > 5) {
                    $funcionario['bonificacao'] = $funcionario['salario'] * 0.20; // 20%
                    $funcionario['classe_linha'] = 'linha-vermelho'; // Classe para coloração
                } elseif ($tempoServico > 1) {
                    $funcionario['bonificacao'] = $funcionario['salario'] * 0.10; // 10%
                    $funcionario['classe_linha'] = 'linha-azul'; // Classe para coloração
                } else {
                    $funcionario['bonificacao'] = 0; // Sem bonificação
                    $funcionario['classe_linha'] = ''; // Sem classe especial
                }
            }
    
            // Passa os dados processados para a view
            $this->view->render(array("titulo" => "Home", "funcionarios" => $funcionarios));
    
        } catch (\PDOException $e) {
            echo "Erro ao conectar ou consultar o banco: " . $e->getMessage();
        }
    }
    
}

?>