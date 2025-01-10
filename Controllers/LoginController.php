<?php 
namespace Controllers;

use Models\Database;

class LoginController extends Controller {

    public function __construct() {
        $this->view = new \Views\MainView('login', null, null);
        // Inicia a sessão se ainda não estiver iniciada
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function executar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email']) ?? '';
            $senha = trim($_POST['senha']) ?? '';
    
            if ($this->validarCredenciais($email, $senha)) {
                // Redireciona para a página inicial após o login bem-sucedido
                header("Location: ".INCLUDE_PATH."home");
                exit();
            } else {
                // Armazena a mensagem de erro na sessão
                $_SESSION['erro_login'] = "Usuário ou senha incorretos.";
                header("Location: ".INCLUDE_PATH."login");
                exit();
            }
        }
    
        // Mostra a página de login e a mensagem de erro, se houver
        $erro_login = $_SESSION['erro_login'] ?? null;
        unset($_SESSION['erro_login']); // Limpa a mensagem de erro após exibição
        $this->view->render(array("titulo" => "login", "erro_login" => $erro_login));
    }
    

    private function validarCredenciais($email, $senha) {
        try {
            $pdo = Database::connect();
            $stmt = $pdo->prepare("SELECT * FROM tbl_usuario WHERE login_email = ?");
            $stmt->execute([$email]);
    
            if ($stmt->rowCount() > 0) {
                $login = $stmt->fetch(\PDO::FETCH_ASSOC);
    
                // Exiba os valores para depuração
                $hashSenhaDigitada = md5($senha);
                $hashSenhaBanco = $login['senha'];
                echo "Email: " . htmlspecialchars($email) . "<br>";
                echo "Senha digitada (MD5): " . $hashSenhaDigitada . "<br>";
                echo "Senha no banco: " . $hashSenhaBanco . "<br>";
    
                // Verificação
                if ($hashSenhaDigitada === $hashSenhaBanco) {
                    $_SESSION['usuario_logado'] = true;
                    $_SESSION['usuario_email'] = $login['login_email']; 
                    $_SESSION['usuario_id'] = $login['id_usuario'];
                    return true;
                } else {
                    echo "Senhas não coincidem.<br>";
                }
            } else {
                echo "Usuário não encontrado.<br>";
            }
        } catch (\PDOException $e) {
            echo "Erro ao acessar o banco: " . $e->getMessage() . "<br>";
        }
    
        return false; 
    }
    
    
     
}
?>