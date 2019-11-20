<?php

class Database {
    private $host;
    private $database;
    private $user;
    private $pass;
    private $connection;

    public function __construct() {
        $this->host = 'localhost';
        $this->database = 'iago';
        $this->user = 'iago';
        $this->pass = 'iago';
    }

    public function conect() {
        $this -> connection = null;

        try {
            $this->connection =
            new PDO('mysql:host = '.$this -> host.';dbname = '.$this -> database, $this -> user, $this -> pass);
            $this -> connection -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } 
        catch (PDOException $e) {
            echo $e -> getMessage();
        } 
        catch (Exception $e) {
            echo $e -> getMessage();
        }

        return $this -> connection;
    }
} //Class Database

$meubanco = new Database();
$conexao = $meubanco -> conect();

if ($conexao == null) {
    echo 'Não conectado!';
} 
else {
    echo 'Conectado!';
}
?>
