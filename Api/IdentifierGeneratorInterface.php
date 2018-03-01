<?php
/**
 * @package  Digibart\MessagesNotification
 * @author Bartosz Herba <bartoszherba@gmail.com>
 */

namespace Digibart\MessagesNotification\Api;

/**
 * Interface IdentifierGeneratorInterface
 */
interface IdentifierGeneratorInterface
{
    /**
     * @param string $input
     *
     * @return string
     */
    public function generate(string $base): string;
}
