<?php
namespace carry0987\FileTree;

use carry0987\Hash\Hash;
use carry0987\FileTree\Exceptions\FileTreeException;

class FileTree
{
    private Hash $hash;
    private bool $organize = false;

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

    public function setOrganize(bool $organize): self
    {
        $this->organize = $organize;

        return $this;
    }

    /**
     * Generate an encrypted URL via Hash.
     * @param string $originalDirectoryPath The original path of the file.
     * 
     * @return string The signed encrypted URL.
     * 
     * @throws FileTreeException If encryption fails or binary signature cannot be generated.
     */
    public function generateEncryptedUrl(string $originalDirectoryPath): string
    {
        if ($this->organize) {
            $originalDirectoryPath = rtrim($originalDirectoryPath, '/').'::org';
        }

        $encryptedBinaryUrl = $this->hash->generateURL($originalDirectoryPath);

        if ($encryptedBinaryUrl === null) {
            throw new FileTreeException('Failed to encrypt the original directory path.');
        }

        return $encryptedBinaryUrl;
    }
}
