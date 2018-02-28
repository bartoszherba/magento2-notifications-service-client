<?php
/**
 * @package  Digibart\MessagesNotification
 * @author Bartosz Herba <bartoszherba@gmail.com>
 */

namespace Digibart\MessagesNotification\Api;

/**
 * Interface ConfigResolverInterface
 */
interface ConfigResolverInterface
{
    /**
     * Configuration paths
     */
    const PATH_ENABLE = 'messages/general/enable';
    const PATH_SERVICE_ENDPOINT = 'messages/general/service_endpoint';
    const PATH_MODE = 'messages/general/mode';

    /**
     * @return bool
     */
    public function getIsEnable(): bool;

    /**
     * @return string
     */
    public function getServiceEndpoint(): string;

    /**
     * @return int
     */
    public function getMode(): int;

}
