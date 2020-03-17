<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */
namespace MSBios\Crypt\Password;

/**
 * Interface ComparatorInterface
 *
 * @package MSBios\Crypt\Password
 */
interface ComparatorInterface
{
    /**
     * Compare an "encoded" and source strings.
     *
     * @return boolean
     */
    public function compare($encoded, $source): bool;
}
