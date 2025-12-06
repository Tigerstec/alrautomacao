<?php

namespace app\config;

/**
 * Classe responsável por carregar variáveis do arquivo .env
 */
class EnvLoader {
    
    private static $loaded = false;
    private static $envVars = [];
    
    /**
     * Carrega as variáveis do arquivo .env
     */
    public static function load() {
        if (self::$loaded) {
            return;
        }
        
        $envFile = __DIR__ . '/../../.env';
        
        if (!file_exists($envFile)) {
            throw new \RuntimeException("Arquivo .env não encontrado em: $envFile");
        }
        
        $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        
        foreach ($lines as $line) {
            // Ignora comentários
            if (strpos(trim($line), '#') === 0) {
                continue;
            }
            
            // Divide a linha em chave e valor
            if (strpos($line, '=') !== false) {
                list($key, $value) = explode('=', $line, 2);
                $key = trim($key);
                $value = trim($value);
                
                // Remove aspas se houver
                if ((substr($value, 0, 1) === '"' && substr($value, -1) === '"') ||
                    (substr($value, 0, 1) === "'" && substr($value, -1) === "'")) {
                    $value = substr($value, 1, -1);
                }
                
                self::$envVars[$key] = $value;
                
                // Define como variável de ambiente do PHP
                putenv("$key=$value");
            }
        }
        
        self::$loaded = true;
    }
    
    /**
     * Obtém o valor de uma variável do .env
     * @param string $key Nome da variável
     * @param mixed $default Valor padrão se não encontrar
     * @return mixed
     */
    public static function get($key, $default = null) {
        self::load();
        return self::$envVars[$key] ?? $default;
    }
    
    /**
     * Retorna todas as variáveis carregadas
     * @return array
     */
    public static function getAll() {
        self::load();
        return self::$envVars;
    }
}
