<?php
/**
 * @access protected
 * @author Judzhin Miles <judzhin[at]gns-it.com>
 */
namespace MSBios\Crypt\Password;

use Laminas\Math\Rand;
use MSBios\Crypt\Exception\RuntimeException;

/**
 * Class Digest
 * @package MSBios\Crypt\Password
 */
class Digest implements EncoderInterface, ComparatorInterface
{
    /** @const DELIMITER */
    const DELIMITER = '$';

    /** @const DEFAULT_SALT_LENGTH */
    const DEFAULT_SALT_LENGTH = 16;

    /** @const */
    const SHA256 = 'sha256';

    /** @const */
    const SHA512 = 'sha512';

    /** @const */
    const SHA1 = 'sha1';

    /** @const */
    const MD5 = 'md5';

    /**
     * Hash function to use for generating salts and passwords
     *
     * @var string
     */
    protected $hashFn;

    /**
     * Digest constructor.
     *
     * @param string $hashFn
     */
    public function __construct($hashFn = '')
    {
        $this->hashFn = $hashFn;
    }

    /**
     * Encodes input string data and returns the encoded content.
     *
     * @param $source
     * @param bool $salt
     * @return string
     * @throws \Throwable
     */
    public function encode($source, $salt = false)
    {
        return $this->encodeWithSalt($source);
    }

    /**
     * Compare an "encoded" and source strings.
     *
     * @param $encoded
     * @param $source
     * @return bool
     * @throws \Throwable
     */
    public function compare($encoded, $source): bool
    {
        /** @var string $delimiter */
        $delimiter = strpos($encoded, self::DELIMITER);

        if ($delimiter !== false) {
            $salt = substr($encoded, 0, $delimiter);
            return $encoded == $this->encodeWithSalt($source, $salt);
        }

        return false;
    }

    /**
     * @param $source
     * @param bool $salt
     * @return string
     * @throws \Throwable
     */
    protected function encodeWithSalt($source, $salt = false): string
    {
        /** @var string $salt */
        $salt = empty($salt) ? $this->createHash(Rand::getString(self::DEFAULT_SALT_LENGTH)) : $salt;
        return $salt . self::DELIMITER . $this->createHash($this->createHash($source) . $salt);
    }

    /**
     * Initialise the hash function
     */
    protected function initialize(): void
    {
        if ($this->hashFn) {
            return;
        }

        if (extension_loaded('hash')) {
            $this->hashFn = self::SHA512;
        } else {
            $this->hashFn = self::SHA1;
        }
    }

    /**
     * Perform the hashing based on the function set
     *
     * @param $data
     * @return string
     * @throws \Throwable
     */
    protected function createHash($data): string
    {
        $this->initialize();
        switch ($this->hashFn) {
            case self::SHA256:
                return hash(self::SHA256, $data);
            case self::SHA512:
                return hash(self::SHA512, $data);
            case self::SHA1:
                return sha1($data);
            case self::MD5:
                return md5($data);
            default:
                throw RuntimeException::unknownHashFunction();
        }
    }
}
