<?php
require_once 'Conexao.php'; // Certifique-se de que o caminho está correto

class Endereco {
    private $cep;
    private $logradouro;
    private $bairro;
    private $cidade;
    private $uf;
    private $pais;

    public function __construct($cep) {
        $this->cep = preg_replace('/[^0-9]/', '', $cep);
        
        // 1. Busca os dados via API
        $jsonBruto = $this->buscarEndereco();
        $decode = json_decode($jsonBruto, true);

        if ($decode && !isset($decode['erro'])) {
            // 2. Mapeia os campos
            $this->logradouro = $decode['logradouro'] ?? '';
            $this->bairro = $decode['bairro'] ?? '';
            $this->cidade = $decode['localidade'] ?? '';
            $this->uf = $decode['uf'] ?? '';
            $this->pais = 'Brasil';

            // 3. Persiste no banco
            $this->insert();
        }
    }

    public function buscarEndereco() {
        if(empty($this->cep)) 
            return json_encode(['erro' => 'CEP vazio']);
        
        $url = "https://viacep.com.br/ws/{$this->cep}/json/";

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }

    private function insert() {
        try {
            $database = new Conexao();
            $db = $database->conectar();

            //SQL INJECTION
            $sql = "INSERT INTO endereco (cep, logradouro, bairro, cidade, uf, pais) 
                    VALUES (:cep, :logradouro, :bairro, :cidade, :uf, :pais)";
            
            $stmt = $db->prepare($sql);

            $stmt->execute([
                ':cep'        => $this->cep,
                ':logradouro' => $this->logradouro,
                ':bairro'     => $this->bairro,
                ':cidade'     => $this->cidade,
                ':uf'         => $this->uf,
                ':pais'       => $this->pais
            ]);
        } catch (PDOException $e) {
            // Log de erro ou tratar como preferir
            error_log("Erro ao inserir: " . $e->getMessage());
        }
    }

 public static function deletar($id): bool {
        try {
            $database = new Conexao();
            $db       = $database->conectar();
    
            $stmt = $db->prepare(
                "Delete FROM endereco where id = :id"
            );
            $stmt->execute([
                ':id' => $id
            ]);
            
            return $stmt->rowCount() > 0; // Retorna true se algum registro foi deletado

        } catch (PDOException $e) {
            error_log("Erro ao deletar: " . $e->getMessage());
            echo "<script>console.log(".$e->getMessage().");</script>";
        }
    }

    public static function listar(): array {
        try {
            $database = new Conexao();
            $db       = $database->conectar();
    
            $stmt = $db->prepare(
                "SELECT id, cep, logradouro, bairro, cidade, uf, pais FROM endereco ORDER BY id DESC"
            );
            $stmt->execute();

            return $stmt->fetchAll(); // FETCH_ASSOC já é o padrão da Conexao
    
        } catch (PDOException $e) {
            error_log("Erro ao listar: " . $e->getMessage());
            echo "<script>console.log(".$e->getMessage().");</script>";
        }
    }

    
    public static function buscarCepzin($cepParaBuscar): array {
        try {
            $database = new Conexao();
            $db       = $database->conectar();
    
            $stmt = $db->prepare(
                "SELECT id, cep, logradouro, bairro, cidade, uf, pais FROM endereco where cep = :cepParaBuscar"
            );
           $stmt->execute([
                ':cepParaBuscar' => $cepParaBuscar
            ]);

            return $stmt->fetchAll(); // FETCH_ASSOC já é o padrão da Conexao
    
        } catch (PDOException $e) {
            error_log("Erro ao listar: " . $e->getMessage());
            echo "<script>console.log(".$e->getMessage().");</script>";
        }
    }

    // Necessário para o 'echo $model' no Controller funcionar
    public function __toString() {
        return json_encode([
            'cep' => $this->cep,
            'logradouro' => $this->logradouro,
            'bairro' => $this->bairro,
            'localidade' => $this->cidade, // 'localidade' para bater com o JS
            'uf' => $this->uf
        ]);
    }

}