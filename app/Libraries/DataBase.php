<?php

class Database {
//atributos
private $host = DB['HOST'];
private $usuario =  DB['USER'];
private $senha =  DB['PASSWORD'];
private $db_name =  DB['DB_NAME'];
private $porta =  DB['PORT'];
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
           phpErro($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
            die();
        }
    }


    //prepara uma query atraves de um metodo do PDO
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
