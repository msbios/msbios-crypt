<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */

namespace MSBiosTest\Crypt\Password;

use MSBios\Crypt\Exception\RuntimeException;
use MSBios\Crypt\Password\Digest;
use PHPUnit\Framework\TestCase;

/**
 * Class DigestTest
 * @package MSBiosTest\Crypt\Password
 */
class DigestTest extends TestCase
{
    /**
     * @param string $hashFn
     * @throws \Throwable
     */
    private function providerTest($hashFn = ''): void
    {
        /** @var Digest $digest */
        $digest = new Digest($hashFn);
        /** @var string $encoded */
        $encoded = $digest->encode($source = '123456');
        $this->assertFalse($digest->compare('Wrong Hash', $source));
        $this->assertTrue($digest->compare($encoded, $source));
    }

    public function testDefaultFunc(): void
    {
        $this->providerTest();
    }

    public function testSHA256Func(): void
    {
        $this->providerTest('sha256');
    }

    public function testSHA1Func(): void
    {
        $this->providerTest('sha1');
    }

    public function testMD5Func(): void
    {
        $this->providerTest('md5');
    }

    public function testWrongFunc(): void
    {
        $this->expectException(RuntimeException::class);
        $this->providerTest('wtf');
    }
}
