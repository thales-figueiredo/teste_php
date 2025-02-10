<?php

require_once 'DispositivoDAO.php';

class ControleDispositivo {
    private $dispositivoDAO;

    public function __construct() {
        $this->dispositivoDAO = new DispositivoDAO();
    }

    public function listarDispositivos() {
        return $this->dispositivoDAO->obterTodosDispositivos();
    }

    public function adicionarDispositivo($dados) {
        try {
            $dispositivo = new Dispositivo(
                $dados['hostname'],
                $dados['ip'],
                $dados['tipo'],
                $dados['fabricante'],
                $dados['modelo']
            );

            return $this->dispositivoDAO->criarDispositivo($dispositivo);
        } catch (Exception $e) {
            echo "Erro ao adicionar dispositivo: " . $e->getMessage();
            return false;
        }
    }

    public function editarDispositivo($id, $dados) {
        $dispositivo = $this->dispositivoDAO->obterDispositivoPorId($id);
        if ($dispositivo) {
            $dispositivo->setHostname($dados['hostname']);
            $dispositivo->setIp($dados['ip']);
            $dispositivo->setTipo($dados['tipo']);
            $dispositivo->setFabricante($dados['fabricante']);
            $dispositivo->setModelo($dados['modelo']);
            if (isset($dados['ativo'])) {
                $dispositivo->setAtivo($dados['ativo']);
            }
            return $this->dispositivoDAO->atualizarDispositivo($dispositivo);
        }
        return false;
    }

    public function inativarDispositivo($id) {
        return $this->dispositivoDAO->inativarDispositivo($id);
    }

    public function ativarDispositivo($id) {
        return $this->dispositivoDAO->ativarDispositivo($id);
    }

    public function obterDispositivo($id) {
        return $this->dispositivoDAO->obterDispositivoPorId($id);
    }
}

