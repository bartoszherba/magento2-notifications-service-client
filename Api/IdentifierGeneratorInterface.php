<?php
/**
 * @package  Digibart\Notifications
 * @author Bartosz Herba <bartoszherba@gmail.com>
 */

namespace Digibart\Notifications\Api;

/**
 * Interface IdentifierGeneratorInterface
 */
interface IdentifierGeneratorInterface
{
    /**
     * @param string $base
     *
     * @return string
     */
    public function generate(string $base): string;
}
