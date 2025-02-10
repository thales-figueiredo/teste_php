<!DOCTYPE html>
<html>
<head>
    <title>Lista de Dispositivos</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h1 class="mt-4">Dispositivos Cadastrados</h1>
    <a href="index.php?acao=adicionar" class="btn btn-primary mb-3">Adicionar Novo Dispositivo</a>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>IP</th>
            <th>Tipo</th>
            <th>Fabricante</th>
            <th>Modelo</th>
            <th>Status</th>
            <th>Data de Cadastro</th>
            <th>Ações</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($dispositivos as $dispositivo): ?>
            <tr>
                <td><?php echo $dispositivo->getId(); ?></td>
                <td><?php echo $dispositivo->getHostname(); ?></td>
                <td><?php echo $dispositivo->getIp(); ?></td>
                <td><?php echo $dispositivo->getTipo(); ?></td>
                <td><?php echo $dispositivo->getFabricante(); ?></td>
                <td><?php echo $dispositivo->getModelo(); ?></td>
                <td><?php echo $dispositivo->isAtivo() ? 'Ativo' : 'Inativo'; ?></td>
                <td><?php echo $dispositivo->getdata_cadastro(); ?></td>
                <td>
                    <?php if ($dispositivo->isAtivo()): ?>
                        <a href="index.php?acao=editar&id=<?php echo $dispositivo->getId(); ?>" class="btn btn-warning btn-sm">Editar</a>
                        <a href="index.php?acao=inativar&id=<?php echo $dispositivo->getId(); ?>" class="btn btn-danger btn-sm">Inativar</a>
                    <?php else: ?>
                        <a href="index.php?acao=ativar&id=<?php echo $dispositivo->getId(); ?>" class="btn btn-success btn-sm">Ativar</a>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>
