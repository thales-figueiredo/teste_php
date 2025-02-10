<?php
require_once 'classes/ConexaoBanco.php';
require_once 'classes/DispositivoDAO.php';

$dispositivoDAO = new DispositivoDAO();
$dispositivos = $dispositivoDAO->obterTodosDispositivos();

$mensagem = "";
$saidaComando = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dispositivoId = $_POST['dispositivo'];
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];
    $comando = $_POST['comando'];


    $dispositivo = $dispositivoDAO->obterDispositivoPorId($dispositivoId);
    $ip = $dispositivo->getIp();

    if (function_exists("ssh2_connect")) {
        $conexao = ssh2_connect($ip, 22); // Porta padrão SSH

        if ($conexao && ssh2_auth_password($conexao, $usuario, $senha)) {
            $stream = ssh2_exec($conexao, $comando);
            stream_set_blocking($stream, true);
            $saidaComando = stream_get_contents($stream);
            fclose($stream);
        } else {
            $mensagem = "Erro: Falha na autenticação SSH.";
        }
    } else {
        $mensagem = "Erro: A função ssh2_connect não está habilitada no servidor.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conexão SSH</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
    <h2>Conectar via SSH</h2>
    <?php if ($mensagem): ?>
        <div class="alert alert-danger"><?php echo $mensagem; ?></div>
    <?php endif; ?>
    <form method="post">
        <div class="form-group">
            <label>Selecione um dispositivo:</label>
            <select class="form-control" name="dispositivo" required>
                <option value="">Escolha...</option>
                <?php foreach ($dispositivos as $disp): ?>
                    <option value="<?php echo $disp->getId(); ?>"><?php echo $disp->getHostname(); ?> (<?php echo $disp->getIp(); ?>)</option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label>Usuário SSH:</label>
            <input type="text" class="form-control" name="usuario" required>
        </div>
        <div class="form-group">
            <label>Senha SSH:</label>
            <input type="password" class="form-control" name="senha" required>
        </div>
        <div class="form-group">
            <label>Comando a executar:</label>
            <input type="text" class="form-control" name="comando" required>
        </div>
        <button type="submit" class="btn btn-primary">Executar Comando</button>
    </form>

    <?php if ($saidaComando): ?>
        <div class="mt-4">
            <h4>Resultado do Comando:</h4>
            <pre class="bg-light p-3"><?php echo htmlspecialchars($saidaComando); ?></pre>
        </div>
    <?php endif; ?>
</div>
</body>
</html>
