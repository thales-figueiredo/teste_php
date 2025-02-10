<?php
require_once __DIR__ . '/config.php';
var_dump(defined('BD_HOST')); // Deve retornar bool(true)
echo BD_HOST;


echo function_exists('openssl_encrypt') ? 'OpenSSL está habilitado' : 'OpenSSL não está habilitado';


?>
