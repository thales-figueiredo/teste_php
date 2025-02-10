<?php
// Configuração de chave AES (32 bytes para AES-256)
define("CHAVE_AES", "12345678901234567890123456789012"); // 32 bytes para AES-256

// Função: Cifra de César
function cifraCesar($texto, $acao, $deslocamento = 3) {
    $resultado = "";
    $offset = ($acao === "criptografar") ? $deslocamento : -$deslocamento;
    for ($i = 0; $i < strlen($texto); $i++) {
        $char = $texto[$i];
        if (ctype_alpha($char)) {
            $base = ctype_upper($char) ? ord('A') : ord('a');
            $novoChar = chr((ord($char) - $base + $offset + 26) % 26 + $base);
            $resultado .= $novoChar;
        } else {
            $resultado .= $char;
        }
    }
    return $resultado;
}

// Função: Criptografia AES-256
function aesEncrypt($texto) {
    // Gerar IV aleatório de 16 bytes
    $iv = openssl_random_pseudo_bytes(16);

    // Criptografar com AES-256-CBC
    $encrypted = openssl_encrypt($texto, 'aes-256-cbc', CHAVE_AES, OPENSSL_RAW_DATA, $iv);
    if ($encrypted === false) {
        return "Erro ao criptografar AES.";
    }

    // Codificar IV + texto criptografado em base64
    return base64_encode($iv . $encrypted); // IV + texto criptografado
}

function aesDecrypt($ciphertext) {
    // Decodificar base64
    $decoded = base64_decode($ciphertext);

    // Verificar se a base64 foi decodificada corretamente
    if ($decoded === false) {
        return "Erro na descriptografia AES. Base64 inválido.";
    }

    // O IV tem sempre 16 bytes, então extraímos os primeiros 16 bytes
    $iv = substr($decoded, 0, 16); // Extrair o IV (primeiros 16 bytes)
    $encrypted = substr($decoded, 16); // Extrair o texto criptografado

    // Descriptografar utilizando o IV extraído
    $decrypted = openssl_decrypt($encrypted, 'aes-256-cbc', CHAVE_AES, OPENSSL_RAW_DATA, $iv);
    return ($decrypted !== false) ? $decrypted : "Erro na descriptografia AES.";
}

// Função: Base64 com inversão de caracteres
function customEncrypt($texto) {
    return strrev(base64_encode($texto)); // Codificar e inverter
}

function customDecrypt($texto) {
    $decoded = base64_decode(strrev($texto)); // Inverter e decodificar
    return ($decoded !== false) ? $decoded : "Erro na descriptografia Custom.";
}

// Função para criptografar todos os métodos
function criptografarTodos($texto) {
    return [
        'cesar'  => cifraCesar($texto, "criptografar"),
        'aes'    => aesEncrypt($texto),
        'custom' => customEncrypt($texto)
    ];
}

// Função para descriptografar todos os métodos
function descriptografarTodos($texto) {
    return [
        'cesar'  => cifraCesar($texto, "descriptografar"),
        'aes'    => aesDecrypt($texto),
        'custom' => customDecrypt($texto)
    ];
}

// Processamento do formulário
$resultadoCesar = $resultadoAES = $resultadoCustom = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $texto = $_POST['texto'];
    $acao = $_POST['acao'];

    if ($acao === "criptografar") {
        $resultados = criptografarTodos($texto);
        $resultadoCesar = $resultados['cesar'];
        $resultadoAES = $resultados['aes'];
        $resultadoCustom = $resultados['custom'];
    } else {
        $resultados = descriptografarTodos($texto); // Descriptografar todos os métodos
        $resultadoCesar = $resultados['cesar'];
        $resultadoAES = $resultados['aes'];
        $resultadoCustom = $resultados['custom'];
    }
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Criptografia PHP</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="container mt-4">
<h2 class="mb-4">Criptografia e Descriptografia</h2>
<form method="post">
    <div class="form-group">
        <label for="texto">Digite o Texto:</label>
        <input type="text" class="form-control" id="texto" name="texto" required>
    </div>
    <div class="form-group">
        <label for="acao">Escolha a Ação:</label>
        <select class="form-control" id="acao" name="acao">
            <option value="criptografar">Criptografar</option>
            <option value="descriptografar">Descriptografar</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Executar</button>
</form>

<?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
    <h3 class="mt-4">Resultados:</h3>
    <p><strong>Teste Cifra de César:</strong> <?php echo htmlspecialchars($resultadoCesar); ?></p>
    <p><strong>AES-256:</strong> <?php echo htmlspecialchars($resultadoAES); ?></p>
    <p><strong>Base64 + Inversão:</strong> <?php echo htmlspecialchars($resultadoCustom); ?></p>
<?php endif; ?>
</body>
</html>
