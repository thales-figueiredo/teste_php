<!DOCTYPE html>
<html>
<head>
    <title>Editar Dispositivo</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h1 class="mt-4">Editar Dispositivo</h1>
    <form method="post" action="index.php?acao=editar">
        <input type="hidden" name="id" value="<?php echo $dispositivo->getId(); ?>">
        <div class="form-group">
            <label for="hostname">Nome</label>
            <input type="text" class="form-control" id="hostname" name="hostname" value="<?php echo $dispositivo->getHostname(); ?>" required>
        </div>
        <div class="form-group">
            <label for="ip">IP</label>
            <input type="text" class="form-control" id="ip" name="ip" value="<?php echo $dispositivo->getIp(); ?>" required>
        </div>
        <div class="form-group">
            <label for="tipo">Tipo</label>
            <select class="form-control" id="tipo" name="tipo">
                <option value="Servidor" <?php echo ($dispositivo->getTipo() == 'Servidor') ? 'selected' : ''; ?>>Servidor</option>
                <option value="Roteador" <?php echo ($dispositivo->getTipo() == 'Roteador') ? 'selected' : ''; ?>>Roteador</option>
                <option value="Switch" <?php echo ($dispositivo->getTipo() == 'Switch') ? 'selected' : ''; ?>>Switch</option>
            </select>
        </div>
        <div class="form-group">
            <label for="fabricante">Fabricante</label>
            <input type="text" class="form-control" id="fabricante" name="fabricante" value="<?php echo $dispositivo->getFabricante(); ?>" required>
        </div>
        <div class="form-group">
            <label for="modelo">Modelo</label>
            <input type="text" class="form-control" id="modelo" name="modelo" value="<?php echo $dispositivo->getModelo(); ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
        <a href="index.php?acao=listar" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
</body>
</html>
