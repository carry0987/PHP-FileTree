<?php
namespace carry0987\FileTree;

use carry0987\Hash\Hash;
use carry0987\FileTree\Exceptions\FileTreeException;

class FileTree
{
    private Hash $hash;

    const ENCRYPT_ALGORITHM = 'sha256';
    const CIPHER = 'aes-256-gcm';

    /**
     * FileTree constructor.
     * @param string $signatureKey Hexadecimal signature key.
     * @param string $signatureSalt Hexadecimal signature salt.
     */
    public function __construct(string $signatureKey, string $signatureSalt)
    {
        $this->hash = new Hash($signatureKey, $signatureSalt);
        $this->hash->setEncryptAlgorithm(self::ENCRYPT_ALGORITHM);
        $this->hash->setCipher(self::CIPHER);
    }

    /**
     * Generate an encrypted URL via Hash.
     * @param string $originalDirectoryPath The original path of the file.
     * 
     * @return string The signed encrypted URL.
     * 
     * @throws FileTreeException If encryption fails or binary signature cannot be generated.
     */
    public function generateEncryptedUrl(string $originalDirectoryPath)
    {
        $encryptedBinaryUrl = $this->hash->generateEncryptedUrl($originalDirectoryPath);

        if ($encryptedBinaryUrl === null) {
            throw new FileTreeException('Failed to encrypt the original directory path.');
        }

        return $encryptedBinaryUrl;
    }
}
