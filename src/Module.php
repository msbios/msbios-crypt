<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */
namespace MSBios\Crypt;

/**
 * Class Module
 *
 * @package MSBios\Crypt
 */
class Module extends \MSBios\Module
{
    /** @var string  */
    const VERSION = '1.0.0';

    /**
     * @inheritDoc
     *
     * @return string
     */
    protected function getDir(): string
    {
        return __DIR__;
    }

    /**
     * @inheritDoc
     *
     * @return string
     */
    protected function getNamespace(): string
    {
        return __NAMESPACE__;
    }
}
