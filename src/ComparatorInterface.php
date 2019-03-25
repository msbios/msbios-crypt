<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */
namespace MSBios\Crypt;

/**
 * Interface ComparatorInterface
 * @package MSBios\Crypt
 */
interface ComparatorInterface
{
    /**
     * Compare an "encoded" and source strings.
     *
     * @return boolean
     */
    public function compare($encoded, $source);
}
