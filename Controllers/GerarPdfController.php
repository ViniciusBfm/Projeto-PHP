<?php

namespace Controllers;

use Models\Database;

class GerarPdfController
{
    public function gerarPdf()
    {
        
        $pdo = Database::connect();

        
        $funcionarios = $this->getFuncionarios($pdo);

        if (!$funcionarios) {
            die("Nenhum funcionário encontrado.");
        }

        // Gerar o PDF manualmente
        $pdf = "%PDF-1.4\n";
        $pdf .= "1 0 obj\n";
        $pdf .= "<< /Type /Catalog /Pages 2 0 R >>\n";
        $pdf .= "endobj\n";
        $pdf .= "2 0 obj\n";
        $pdf .= "<< /Type /Pages /Kids [3 0 R] /Count 1 >>\n";
        $pdf .= "endobj\n";
        $pdf .= "3 0 obj\n";
        $pdf .= "<< /Type /Page /Parent 2 0 R /MediaBox [0 0 595.276 841.890] /Contents 4 0 R >>\n";
        $pdf .= "endobj\n";

        // Conteúdo do PDF
        $content = "BT\n/F1 12 Tf\n100 800 Td\n(Lista de Funcionarios) Tj\nET\n";

        $y = 780; // Coordenada inicial para os nomes
        foreach ($funcionarios as $funcionario) {
            $content .= "BT\n/F1 10 Tf\n";
            $content .= "100 $y Td\n(" . $funcionario['nome'] . ") Tj\n";
            $content .= "ET\n";
            $y -= 20; // Ajusta a posição vertical para a próxima linha
        }

        $pdf .= "4 0 obj\n<< /Length " . strlen($content) . " >>\nstream\n$content\nendstream\nendobj\n";
        $pdf .= "xref\n0 5\n0000000000 65535 f \n0000000010 00000 n \n0000000053 00000 n \n0000000107 00000 n \n0000000271 00000 n \n";
        $pdf .= "trailer\n<< /Size 5 /Root 1 0 R >>\nstartxref\n297\n%%EOF\n";

        // Configurar cabeçalhos para exibir o PDF no navegador
        header('Content-Type: application/pdf');
        header('Content-Disposition: inline; filename="funcionarios.pdf"');
        echo $pdf;
    }

    private function getFuncionarios($pdo)
    {
        try {
            $stmt = $pdo->query('SELECT nome FROM tbl_funcionario');
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            echo "Erro ao buscar funcionários: " . $e->getMessage();
            return [];
        }
    }
}?>