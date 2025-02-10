<?php


require_once 'ConexaoBanco.php';
require_once 'Dispositivo.php';

class DispositivoDAO {
    private $conexao;

    public function __construct() {

        $this->conexao = ConexaoBanco::obterInstancia()->obterConexao();
    }

    public function obterTodosDispositivos() {
        $dispositivos = array();
        $resultado = $this->conexao->query("SELECT * FROM dispositivos");
        while ($linha = $resultado->fetch_assoc()) {
            $dispositivo = new Dispositivo(
                $linha['hostname'],
                $linha['ip'],
                $linha['tipo'],
                $linha['fabricante'],
                $linha['modelo'],
                $linha['ativo'],
                $linha['data_cadastro'],
                $linha['id']
            );
            $dispositivos[] = $dispositivo;
        }
        return $dispositivos;
    }

    public function criarDispositivo(Dispositivo $dispositivo) {

        if ($this->existeDispositivoPorIp($dispositivo->getIp())) {
            throw new Exception("Erro: O dispositivo com o IP {$dispositivo->getIp()} já existe.");
        }

        $stmt = $this->conexao->prepare("INSERT INTO dispositivos (hostname, ip, tipo, fabricante, modelo, ativo) VALUES (?, ?, ?, ?, ?, ?)");

        $hostname    = $dispositivo->getHostname();
        $ip          = $dispositivo->getIp();
        $tipo        = $dispositivo->getTipo();
        $fabricante  = $dispositivo->getFabricante();
        $modelo      = $dispositivo->getModelo();
        $ativo       = $dispositivo->isAtivo();


        $stmt->bind_param("sssssi", $hostname, $ip, $tipo, $fabricante, $modelo, $ativo);

        return $stmt->execute();
    }

    public function atualizarDispositivo(Dispositivo $dispositivo) {
        $stmt = $this->conexao->prepare("UPDATE dispositivos SET hostname=?, ip=?, tipo=?, fabricante=?, modelo=?, ativo=? WHERE id=?");

        // Obter os valores e armazená-los em variáveis
        $hostname    = $dispositivo->getHostname();
        $ip          = $dispositivo->getIp();
        $tipo        = $dispositivo->getTipo();
        $fabricante  = $dispositivo->getFabricante();
        $modelo      = $dispositivo->getModelo();
        $ativo       = $dispositivo->isAtivo();
        $id          = $dispositivo->getId();

        // Agora passe as variáveis para bind_param
        $stmt->bind_param("ssssssi", $hostname, $ip, $tipo, $fabricante, $modelo, $ativo, $id);

        return $stmt->execute();
    }


    public function inativarDispositivo($id) {
        $stmt = $this->conexao->prepare("UPDATE dispositivos SET ativo=0 WHERE id=?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public function ativarDispositivo($id) {
        $stmt = $this->conexao->prepare("UPDATE dispositivos SET ativo = 1 WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }


    public function obterDispositivoPorId($id) {
        $stmt = $this->conexao->prepare("SELECT * FROM dispositivos WHERE id=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $resultado = $stmt->get_result();
        if ($linha = $resultado->fetch_assoc()) {
            return new Dispositivo(
                $linha['hostname'],
                $linha['ip'],
                $linha['tipo'],
                $linha['fabricante'],
                $linha['modelo'],
                $linha['ativo'],
                $linha['data_cadastro'],
                $linha['id']
            );
        }
        return null;
    }

    public function existeDispositivoPorIp($ip) {
        $stmt = $this->conexao->prepare("SELECT id FROM dispositivos WHERE ip = ?");
        $stmt->bind_param("s", $ip);
        $stmt->execute();
        $resultado = $stmt->get_result();
        return $resultado->num_rows > 0;
    }



}

