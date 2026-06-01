<?php
class Conexao{
    private $host     = "localhost";
    private $db_name  = "pwiiib";
    private $username = "root";
    private $password = "";
    public  $connection;
    
    public function conectar(){
        $this->connection = null;

        try{
            //DNS
            $dns = "mysql:host=".$this->host.";dbname=".$this->db_name.";charset=utf8";

            //instanciando PDO para conexão com banco de dados
            //https://www.php.net/manual/pt_BR/pdo.construct.php
            $this->connection = new PDO($dns, $this->username, $this->password);

            //https://www.php.net/manual/pt_BR/pdo.setattribute.php
            //configuração de erro para lançar exceção
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            //Define o retorno padrão como array associativo
            $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        }catch(PDOException $exception){
            echo "Erro de conexão: ".$exception->getMessage();
        }

        return $this->connection;
    }
}