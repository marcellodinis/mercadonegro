<?php

    namespace Mercadonegro;

    use Rain\Tpl;

class Page {

    private $tpl;
    private $options = [];
    private $defaults = [

        "data"=>[]
    ];

    public function __construct($opts = array()){

        $this->options = array_merge($this->defaults, $opts);

        $config = array(
            "tpl_dir"       => $_SERVER["DOCUMENT_ROOT"]."/views/", //Não esquecer de criar a pasta 'views' para o template.
            "cache_dir"     => $_SERVER["DOCUMENT_ROOT"]."/views-cache/",
            "debug"         => false // não preciso de debug.
           );

        Tpl::configure( $config );

        $this->tpl= new Tpl;

        $this->setData($this->options["data"]);

        $this->tpl->draw("header");

    }

    private function setData($data = array())
        {
        foreach ($data as $key => $value) {
            $this->tpl->assign($key, $value);

        }
    }

    public function setTpl($name, $data = array(), $returnHTML = false)
    {

        $this->setData($data); //Já criei o método acima. Basta chamá-lo.

        $this->tpl->draw($name, $returnHTML); //Pronto pra chamar o template. 
    }

    public function __destruct(){


    $this->tpl->draw("footer"); 


    }

}
//DATA =/= DATE. Já chega dessa gafe Marcello.
?>
