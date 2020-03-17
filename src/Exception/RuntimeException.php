<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */
namespace MSBios\Crypt\Exception;

/**
 * Class RuntimeException
 *
 * @package MSBios\Crypt\Exception
 */
class RuntimeException extends \MSBios\Exception\RuntimeException
{
    /**
     * @return \Throwable
     */
    public static function unknownHashFunction(): \Throwable
    {
        return self::create('Unknown hash function!');
    }
}
