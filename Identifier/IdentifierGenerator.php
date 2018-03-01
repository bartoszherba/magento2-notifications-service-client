<?php
/**
 * @package  Digibart\MessagesNotification
 * @author Bartosz Herba <bartoszherba@gmail.pl>
 */

namespace Digibart\MessagesNotification\Identifier;

use Digibart\MessagesNotification\Api\IdentifierGeneratorInterface;

/**
 * Class IdentifierGenerator
 */
class IdentifierGenerator implements IdentifierGeneratorInterface
{
    /**
     * @param string $base
     *
     * @return string
     */
    public function generate(string $base): string
    {
        return base64_encode(str_pad($base, 10, "0", STR_PAD_LEFT));
    }
}
