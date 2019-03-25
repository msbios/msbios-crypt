<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */
namespace MSBios\Crypt;

/**
 * Interface EncoderInterface
 * @package MSBios\Crypt
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
