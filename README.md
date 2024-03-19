# PHP-FileTree
[![Packgist](https://img.shields.io/packagist/v/carry0987/filetree.svg?style=flat-square)](https://packagist.org/packages/carry0987/filetree)  
A PHP script for generating signed and encrypted URLs with **[FileTree-API](https://github.com/carry0987/FileTree-API/)**, using AES-256-GCM and HMAC-SHA256.

## Installation
Use Composer to install PHP-FileTree in your project:

```shell
composer require carry0987/filetree
```

## Configuration
To use PHP-FileTree, you need to have a signature key and signature salt for encryption and hashing. These should be provided as hexadecimal strings.

## Usage
Below is an example demonstrating how to encrypt an URL using PHP-FileTree:

```php
require_once 'vendor/autoload.php';

use carry0987\FileTree\FileTree;

// Initialize the keys and salt. Replace these values with your actual keys and salt.
$signatureKey = 'your_hex_signature_key';
$signatureSalt = 'your_hex_signature_salt';

// Create a new instance of PHP-FileTree.
$imageEncryptor = new FileTree($signatureKey, $signatureSalt);

// The URL of the folder you want to encrypt.
$originalPath = 'test/hello-world';

try {
    $signedUrl = $encryptor->generateEncryptedUrl($originalPath);
    echo 'http://127.0.0.1:3000' . $signedUrl;
} catch (Exception $e) {
    // handle exceptions
    echo "An error occurred: " . $e->getMessage();
}
```

## Contributing
Contributions to PHP-FileTree are welcome! Feel free to submit pull requests to improve the codebase.

## License
This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.
