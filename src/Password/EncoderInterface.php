<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */
namespace MSBios\Crypt\Password;

/**
 * Interface EncoderInterface
 *
 * @package MSBios\Crypt\Password
 */
interface EncoderInterface
{
    /**
     * Encodes input string data and returns the encoded content.
     *
     * @return string
     */
    public function encode($source);
}
