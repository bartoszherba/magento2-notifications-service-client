<?php
/**
 * @package  Digibart\Notifications
 * @author Bartosz Herba <bartoszherba@gmail.pl>
 */

namespace Digibart\Notifications\Identifier;

use Digibart\Notifications\Api\ConfigResolverInterface;
use Digibart\Notifications\Api\IdentifierGeneratorInterface;

/**
 * Class IdentifierGenerator
 */
class IdentifierGenerator implements IdentifierGeneratorInterface
{
    /**
     * @var ConfigResolverInterface
     */
    private $configResolver;

    /**
     * IdentifierGenerator constructor.
     *
     * @param ConfigResolverInterface $configResolver
     */
    public function __construct(ConfigResolverInterface $configResolver)
    {
        $this->configResolver = $configResolver;
    }

    /**
     * Will generate identifier as [$namespace-$base]
     *
     * @param string $base
     *
     * @return string
     */
    public function generate(string $base): string
    {
        return implode('-', [$this->configResolver->getNamespace(), $base]);
    }
}
