<?php 
namespace Views;

class MainView
{
    private $fileName;
    private $header;
    private $footer;
    private $nav;

    const titulo = 'MYPHP';
    
    public function __construct($fileName, $header = 'header', $nav = 'nav', $footer = 'footer')
    {
        $this->fileName = $fileName;
        $this->header = $header;
        $this->nav = $nav;
        $this->footer = $footer;
    }
    
    public function render($arr = [])
    {
        // Extrair variáveis do array para uso no template
        extract($arr);

        if ($this->header) {
            include('pages/templates/'.$this->header.'.php');
        }

        if ($this->nav) {
            include('pages/templates/'.$this->nav.'.php');
        }


        include('pages/'.$this->fileName.'.php');
        
        if ($this->footer) {
            include('pages/templates/'.$this->footer.'.php');
        }
    }
}

?>