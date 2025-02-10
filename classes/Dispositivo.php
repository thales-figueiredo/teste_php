<?php
// classes/Dispositivo.php

class Dispositivo {
    private $id;
    private $hostname;
    private $ip;
    private $tipo;
    private $fabricante;
    private $modelo;
    private $ativo;
    private $data_cadastro;

    public function __construct($hostname, $ip, $tipo, $fabricante, $modelo, $ativo = 1, $data_cadastro = null, $id = null) {
        $this->id           = $id;
        $this->hostname     = $hostname;
        $this->ip           = $ip;
        $this->tipo         = $tipo;
        $this->fabricante   = $fabricante;
        $this->modelo       = $modelo;
        $this->ativo        = $ativo;
        $this->data_cadastro = $data_cadastro;
    }

    public function getId()           { return $this->id; }
    public function getHostname()         { return $this->hostname; }
    public function getIp()           { return $this->ip; }
    public function getTipo()         { return $this->tipo; }
    public function getFabricante()   { return $this->fabricante; }
    public function getModelo()       { return $this->modelo; }
    public function isAtivo()         { return $this->ativo; }
    public function getdata_cadastro() { return $this->data_cadastro; }

    public function setHostname($hostname)           { $this->hostname = $hostname; }
    public function setIp($ip)               { $this->ip = $ip; }
    public function setTipo($tipo)           { $this->tipo = $tipo; }
    public function setFabricante($fabricante){ $this->fabricante = $fabricante; }
    public function setModelo($modelo)       { $this->modelo = $modelo; }
    public function setAtivo($ativo)         { $this->ativo = $ativo; }
    public function setdata_cadastro($data_cadastro) { $this->data_cadastro = $data_cadastro; }
}

