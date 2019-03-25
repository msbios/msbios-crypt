<?php
/**
 * @access protected
 * @author Judzhin Miles <judzhin[at]gns-it.com>
 */
namespace MSBios\Crypt\Digest;

use MSBios\Crypt\ComparatorInterface;
use MSBios\Crypt\EncoderInterface;
use MSBios\Crypt\Exception\RuntimeException;
use Zend\Math\Rand;

/**
 * Class Password
 * @package MSBios\Crypt\Digest
 */
class Password implements EncoderInterface, ComparatorInterface
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
     * SaltCrypt constructor.
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
     */
    public function compare($encoded, $source)
    {
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
     */
    protected function encodeWithSalt($source, $salt = false)
    {
        $salt = empty($salt) ? $this->createHash(Rand::getString(self::DEFAULT_SALT_LENGTH)) : $salt;
        return $salt . self::DELIMITER . $this->createHash($this->createHash($source) . $salt);
    }

    /**
     * Initialise the hash function
     */
    protected function initialize()
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
     */
    protected function createHash($data)
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
                throw new RuntimeException("Unknown hash function!");
        }
    }
}
