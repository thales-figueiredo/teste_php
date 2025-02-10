<?php


require_once 'config.php';
require_once 'classes/ConexaoBanco.php';
require_once 'classes/Dispositivo.php';
require_once 'classes/DispositivoDAO.php';
require_once 'classes/ControleDispositivo.php';

$controle = new ControleDispositivo();

$acao = isset($_GET['acao']) ? $_GET['acao'] : 'listar';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $acao == 'adicionar') {
    $resultado = $controle->adicionarDispositivo($_POST);
    if ($resultado) {
        $_SESSION['mensagem'] = "✅ Dispositivo cadastrado com sucesso!";
        $_SESSION['mensagem_tipo'] = "alert-success"; // Verde para sucesso
        header("Location: index.php?acao=adicionar");
        exit;
    } else {
        $_SESSION['mensagem'] = "❌ Erro ao adicionar dispositivo. Verifique se o IP já existe.";
        $_SESSION['mensagem_tipo'] = "alert-danger"; // Vermelho para erro
        header("Location: index.php?acao=adicionar");
        exit;
    }
}

if ($acao == 'listar') {
    $dispositivos = $controle->listarDispositivos();
    include 'views/listar.php';
} elseif ($acao == 'adicionar') {
    include 'views/adicionar.php';
} elseif ($acao == 'editar') {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $dispositivo = $controle->obterDispositivo($id);
        if (!$dispositivo) {
            echo "Dispositivo não encontrado.";
            exit;
        }
        include 'views/editar.php';
    } else {
        echo "ID do dispositivo não informado.";
        exit;
    }
} elseif ($acao == 'inativar') {
    $id = $_GET['id'];
    $controle->inativarDispositivo($id);
    header("Location: index.php");
    exit;
} elseif ($acao == 'ativar') {
    $id = $_GET['id'];
    $controle->ativarDispositivo($id);
    header("Location: index.php");
    exit;
} else {
    echo "Ação não reconhecida.";
}
?>
