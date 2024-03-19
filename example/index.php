<?php
require dirname(__DIR__).'/vendor/autoload.php';

use carry0987\FileTree\FileTree;

$signatureKey = '691e523490bf50a5323572fff18c2dc0625c69dc449be7bc3ecf47840f17a85b';
$signatureSalt = 'ca0d2b3a2b990217cb336ef159fac050f54216d6dacc53509254e23abb1a8b06';

$encryptor = new FileTree($signatureKey, $signatureSalt);

$originalPath = 'test/hello-world';

try {
    $signedUrl = $encryptor->generateEncryptedUrl($originalPath);
    echo 'http://127.0.0.1:3000' . $signedUrl;
} catch (Exception $e) {
    // handle exceptions
    echo "An error occurred: " . $e->getMessage();
}
