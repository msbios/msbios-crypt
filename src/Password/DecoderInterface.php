<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */

namespace MSBios\Crypt\Password;

/**
 * Interface DecoderInterface
 *
 * @package MSBios\Crypt\Password
 */
interface DecoderInterface
{
    /**
     * Decodes an "encoded" string and returns a "decoded" content.
     *
     * @return string
     */
    public function decode($source) : string;
}
