<?php

class MyClass {
    private $nome;
    public function __construct($nome) {
        $this->nome = $nome;
    }

    public function cumprimento(){
        return $this->nome;
    }
}

$usuario = new MyClass('Iago');
echo 'Olá '.$usuario -> cumprimento();
?>
