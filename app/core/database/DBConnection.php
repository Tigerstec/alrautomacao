<?php

namespace core\database;

use PDO;
use PDOException;
use RuntimeException;
use app\config\EnvLoader;

class DBConnection {
    
    /** @var PDO Armazena a conexão PDO */
    private $conn;

    // Configurações do Banco de Dados (Carregadas do arquivo .env)
    private $host;
    private $user;
    private $pass;
    private $dbname;
    private $port;
    
    /**
     * Construtor da classe.
     * Inicia a conexão assim que a classe é instanciada.
     */
    public function __construct() {
        // Carrega as variáveis do .env
        EnvLoader::load();
        
        $this->host = EnvLoader::get('DB_HOST');
        $this->user = EnvLoader::get('DB_USER');
        $this->pass = EnvLoader::get('DB_PASS');
        $this->dbname = EnvLoader::get('DB_SCHEMA');
        $this->port = EnvLoader::get('DB_PORT', '3306');
        
        try {
            // Monta a string de conexão (DSN)
            $dsn = "mysql:host={$this->host};port={$this->port};dbname={$this->dbname};charset=utf8mb4";
            
            // Cria a instância do PDO
            $this->conn = new PDO($dsn, $this->user, $this->pass);
            
            // Configurações de erro e charset
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $this->conn->exec("SET NAMES utf8mb4");
            
        } catch(PDOException $e) {
            // Em produção, evite exibir o erro detalhado diretamente ao usuário
            throw new RuntimeException("Falha na conexão com o banco de dados: " . $e->getMessage());
        }
    }
    
    /**
     * Retorna a conexão PDO ativa (getter).
     * Útil se você precisar usar métodos nativos do PDO fora desta classe.
     */
    public function getConn() {
        return $this->conn;
    }

    /**
     * Executa uma consulta SQL simples (SELECT).
     * @param string $sqlCommand
     * @return array
     */
    public function query($sqlCommand) {
        try {
            $stmt = $this->conn->query($sqlCommand);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $error) {
            throw new RuntimeException("Erro na consulta: " . $error->getMessage());
        }
    }
    
    /**
     * Executa uma consulta preparada (INSERT, UPDATE, DELETE ou SELECT com parâmetros).
     * seguro contra SQL Injection.
     * @param string $sqlCommand O SQL com placeholders (?)
     * @param array $values Os valores para substituir os ?
     */
    public function prepareQuery($sqlCommand, $values) {
        try {
            $stmt = $this->conn->prepare($sqlCommand);
            $stmt->execute($values);
            // Se for SELECT, retorna os dados. Se não, retorna vazio ou pode ser adaptado.
            if (stripos(trim($sqlCommand), 'SELECT') === 0) {
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
            return true;
        } catch (PDOException $error) {
            throw new RuntimeException("Erro na execução preparada: " . $error->getMessage());
        }
    }
}