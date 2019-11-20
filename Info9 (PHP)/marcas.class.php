<?php

error_reporting(E_ALL);
ini_set('display_errors', 'on');

class Automovel {

    private $conn;
    private $table;

    public function __construct($db) {
            $this->table='marcas';
            $this->conn=$db;
    }

    public function readAll() {
        // Testes
        $sql='select * from '.$this->table;
        $d=$this->conn->prepare($sql);
        $d->execute();
        $dados=$d->fetchAll(PDO::FETCH_ASSOC);
        return $dados;
    }

    public function readOne($id){
        // Testes
        $sql='select * from '.$this->table. ' where id=?';
        $d=$this->conn->prepare($sql);
        $d->execute(array($id));
        $dados=$d->fetch(PDO::FETCH_ASSOC);
        return $dados;
    }

    public function delete($id){
        // Testes
        $sql='DELETE FROM '.$this->table. ' WHERE id=?';
        $d=$this->conn->prepare($sql);
        $d->execute(array($id));
        $c=$d->rowCount();
        return $c;
    }

    public function insert($nome, $origem, $presidente, $fundacao){
        // Testes
        $sql='INSERT INTO '.$this->table. ' (Nome, Origem, Presidente, Fundacao) VALUES (?, ?, ?, ?)';
        $d=$this->conn->prepare($sql);
        $d->execute(array($nome, $origem, $presidente, $fundacao));
        $c=$d->rowCount();
        return $c;
    }

    public function update($id, $nome, $origem, $presidente, $fundacao){
        // Testes
        $sql='UPDATE '.$this->table. ' SET Nome = ?, Origem = ?, Presidente = ?, Fundacao = ? WHERE id=?';
        $d=$this->conn->prepare($sql);
        $d->execute(array($nome, $origem, $presidente, $fundacao, $id));
        $c=$d->rowCount();
        return $c;
    }
}















