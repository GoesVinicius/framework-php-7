<?php

class Database {
//atributos
private $host = 'localhost';
private $usuario = 'root';
private $senha = '';
private $db_name = 'framework';
private $porta = '3306';
private $dbh;
private $stmt;

    public function __construct()
    {
        $dsn = 'mysql:host=' . $this->host .';port=' .$this->porta. ';dbname=' .$this->db_name;

        $opcoes = [
            PDO::ATTR_PERSISTENT => TRUE,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];

        try{
            $this->dbh = new PDO($dsn, $this->usuario, $this->senha, $opcoes);
        
        } catch(PDOException $e){
            print "Problema ao se conectar ao banco de dados: " . $e->getMessage() . "<br>";
            die();
        }
    }

    // prepara uma query atraves de um metodo do PDO
    public function query($sql){
        $this->stmt = $this->dbh->prepare($sql);
    }

    public function bind($param, $valor, $tipo = null){

        if(is_null($tipo)){
            switch(true){
                case is_int($valor):
                    $tipo = PDO::PARAM_INT;
                    break;
                case is_bool($valor):
                    $tipo = PDO::PARAM_BOOL;
                    break;
                case is_null($valor):
                    $tipo = PDO::PARAM_NULL;
                    break;
                default:
                    $tipo = PDO::PARAM_STR;
                    
            }
        }

        $this->stmt->bindValue($param, $valor, $tipo);
    }

    public function executa(){
        return $this->stmt->execute();
    }

    public function resultado(){
        $this->executa();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    public function resultados(){
        $this->executa();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function totalResultados(){
        return $this->stmt->rowCount();
    }

    public function ultimoIdInserido(){
        return $this->dbh->lastInsertId();
    }
}
