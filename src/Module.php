<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */
namespace MSBios\Crypt;

/**
 * Class Module
 * @package MSBios\Crypt
 */
class Module extends \MSBios\Module
{
    /** @var string  */
    const VERSION = '1.0.0';

    /**
     * @return string
     */
    protected function getDir()
    {
        return __DIR__;
    }

    /**
     * @return string
     */
    protected function getNamespace()
    {
        return __NAMESPACE__;
    }
}
