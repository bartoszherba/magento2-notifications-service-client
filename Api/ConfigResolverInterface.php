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
    const PATH_ALWAYS_KEEP_MESSAGE = 'messages/general/always_keep_message';

    /**
     * @return bool
     */
    public function getIsEnable(): bool;

    /**
     * @return string
     */
    public function getServiceEndpoint(): string;

    /**
     * @return bool
     */
    public function getIsAlwaysKeepMessage(): bool;

}
