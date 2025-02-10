<?php

require_once __DIR__.'/../config.php';

class ConexaoBanco {
    private static $instancia = null;
    private $conexao;

    private function __construct() {
        $this->conexao = new mysqli(BD_HOST, BD_USUARIO, BD_SENHA, BD_NOME);
        if ($this->conexao->connect_error) {
            die("Erro na conexão: " . $this->conexao->connect_error);
        }
    }
    public static function obterInstancia() {
        if (!self::$instancia) {
            self::$instancia = new ConexaoBanco();
        }
        return self::$instancia;
    }
    public function obterConexao() {
        return $this->conexao;
    }
}

