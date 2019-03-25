<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */

namespace MSBios\Crypt;

/**
 * Interface DecoderInterface
 * @package MSBios\Crypt
 */
interface DecoderInterface
{
    /**
     * Decodes an "encoded" string and returns a "decoded" content.
     *
     * @return string
     */
    public function decode($source);
}
