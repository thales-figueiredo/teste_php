
<!DOCTYPE html>
<html>
<head>
    <title>Adicionar Dispositivo</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h1 class="mt-4">Adicionar Novo Dispositivo</h1>


    <?php if (!empty($_SESSION['mensagem'])): ?>
        <div class="alert <?= $_SESSION['mensagem_tipo'] ?? 'alert-info' ?>" role="alert">
            <?= $_SESSION['mensagem'] ?>
        </div>
        <?php
        unset($_SESSION['mensagem']);
        unset($_SESSION['mensagem_tipo']);
        ?>
    <?php endif; ?>


<form method="post" action="index.php?acao=adicionar">
        <div class="form-group">
            <label for="hostname">Nome do dispositivo</label>
            <input type="text" class="form-control" id="hostname" name="hostname" required>
        </div>
        <div class="form-group">
            <label for="ip">IP</label>
            <input type="text" class="form-control" id="ip" name="ip" required>
        </div>
        <div class="form-group">
            <label for="tipo">Tipo</label>
            <select class="form-control" id="tipo" name="tipo">
                <option value="Servidor">Servidor</option>
                <option value="Roteador">Roteador</option>
                <option value="Switch">Switch</option>
            </select>
        </div>
        <div class="form-group">
            <label for="fabricante">Fabricante</label>
            <input type="text" class="form-control" id="fabricante" name="fabricante" required>
        </div>
        <div class="form-group">
            <label for="modelo">Modelo</label>
            <input type="text" class="form-control" id="modelo" name="modelo" required>
        </div>
        <button type="submit" class="btn btn-primary">Cadastrar</button>
        <a href="index.php?acao=listar" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
</body>
</html>
