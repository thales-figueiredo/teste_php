<?php
// Função para gerar SHA512 com 5.000 rounds
function generateSHA512($texto) {
    return hash('sha512', $texto, false); // Hash simples SHA512 (sem rounds)
}

// Função para gerar SHA512 com 5.000 rounds
function generateSHA512WithRounds($texto, $rounds = 5000) {
    $hash = $texto;
    for ($i = 0; $i < $rounds; $i++) {
        $hash = hash('sha512', $hash);
    }
    return $hash;
}

// Função para gerar HMAC usando SHA256
function generateHMAC($texto, $key) {
    return hash_hmac('sha256', $texto, $key);
}

// Função para gerar um hash usando SHA-256 (substituindo BLAKE2b)
function generateSHA256($texto) {
    return hash('sha256', $texto);
}

// Função para comparar os hashes
function compareHashes($generatedHash, $userHash) {
    return hash_equals($generatedHash, $userHash) ? "Igual" : "Diferente";
}

$resultadoSHA512 = "";
$resultadoHMAC = "";
$resultadoSHA256 = "";
$comparacaoSHA512 = "";
$comparacaoHMAC = "";
$comparacaoSHA256 = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $texto = $_POST['texto'];
    $hashUsuario = $_POST['hash_usuario'];

    // Gerar os hashes
    $resultadoSHA512 = generateSHA512WithRounds($texto);
    $resultadoHMAC = generateHMAC($texto, 'minha_chave_secreta');
    $resultadoSHA256 = generateSHA256($texto); // Usando SHA-256 no lugar de BLAKE2b

    // Comparar os hashes
    $comparacaoSHA512 = compareHashes($resultadoSHA512, $hashUsuario);
    $comparacaoHMAC = compareHashes($resultadoHMAC, $hashUsuario);
    $comparacaoSHA256 = compareHashes($resultadoSHA256, $hashUsuario); // Comparando o SHA-256
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comparação de Hashes</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="container mt-4">
<h2 class="mb-4">Gerar e Comparar Hashes</h2>
<form method="post">
    <div class="form-group">
        <label for="texto">Digite o Texto:</label>
        <input type="text" class="form-control" id="texto" name="texto" required>
    </div>
    <div class="form-group">
        <label for="hash_usuario">Digite o Hash para Comparação:</label>
        <input type="text" class="form-control" id="hash_usuario" name="hash_usuario">
    </div>
    <button type="submit" class="btn btn-primary">Gerar Hashes</button>
</form>

<?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
    <h3 class="mt-4">Resultados:</h3>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Hash Gerado</th>
            <th>Hash do Usuário</th>
            <th>Resultado</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td><strong>SHA512</strong><br><?php echo htmlspecialchars($resultadoSHA512); ?></td>
            <td><?php echo htmlspecialchars($hashUsuario); ?></td>
            <td><?php echo $comparacaoSHA512; ?></td>
        </tr>
        <tr>
            <td><strong>HMAC</strong><br><?php echo htmlspecialchars($resultadoHMAC); ?></td>
            <td><?php echo htmlspecialchars($hashUsuario); ?></td>
            <td><?php echo $comparacaoHMAC; ?></td>
        </tr>
        <tr>
            <td><strong>SHA-256 (Substituindo BLAKE2b)</strong><br><?php echo htmlspecialchars($resultadoSHA256); ?></td>
            <td><?php echo htmlspecialchars($hashUsuario); ?></td>
            <td><?php echo $comparacaoSHA256; ?></td>
        </tr>
        </tbody>
    </table>
<?php endif; ?>
</body>
</html>
