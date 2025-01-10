<?php
// Inicia a sessão para o gerenciamento do estado do usuário
session_start();

define('INCLUDE_PATH','http://localhost/MVC/');
define('INCLUDE_PATH_FULL','http://localhost/MVC/Views/pages/');
define('INCLUDE_IMAGES','http://localhost/MVC/Views/pages/image');
define('INCLUDE_LOGOUT','http://localhost/MVC/Controllers/LogoutController.php');

class Application
{
    public function executar()
    {
        // URLs que não requerem autenticação
        $publicPages = ['login'];

        // Obtém a URL atual
        $url = isset($_GET['url']) ? explode('/', $_GET['url'])[0] : 'login';

        // Verifica se a página não está na lista de páginas públicas e o usuário não está logado
        if (!isset($_SESSION['usuario_logado']) && !in_array(strtolower($url), $publicPages)) {
            // Redireciona para a página de login
            header('Location: ' . INCLUDE_PATH . 'login');
            exit();
        }
        if ($url === 'deletarsolicitacao' && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller = new Controllers\DeletarFuncionarioController();
            $controller->executar(); // Chama o método 
            return; // Para garantir que a execução pare aqui
        }
        if ($url === 'atualizarusuario' && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller = new Controllers\AtualizarFuncionarioController();
            $controller->executar();
            return; // Para garantir que a execução pare aqui
        }
        if ($url === 'gerar-pdf' && $_SERVER['REQUEST_METHOD'] === 'POST') {
            // Criar uma instância do controlador
            $controller = new \Controllers\GerarPdfController();
        
            // Chamar o método para gerar o PDF
            $controller->gerarPdf();
            return; // Interrompe a execução aqui
        }
        

      
        // Normaliza a URL para carregar o controlador correspondente
        $url = ucfirst($url);
        $url .= "Controller";

        if (file_exists('Controllers/' . $url . '.php')) {
            $className = 'Controllers\\' . $url;
            $controller = new $className;
            $controller->executar();
        } else {
            die("Essa página não existe");
        }
    }
}
?>