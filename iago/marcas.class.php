<?php

class Automovel{
    private $conn;
    private $table;

    public function __construct($db){
        $db->table = 'marcas';
        $this->conn = $db;
    }

    public function readAll(){
        $sql = 'select * from '.$this->table;
        $d = $this->conn->prepare($sql);
        $d->execute();
        $dados = $d->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
