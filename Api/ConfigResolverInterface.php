<?php
/**
 * @package  Digibart\Notifications
 * @author Bartosz Herba <bartoszherba@gmail.com>
 */

namespace Digibart\Notifications\Api;

/**
 * Interface ConfigResolverInterface
 */
interface ConfigResolverInterface
{
    /**
     * Configuration paths
     */
    const PATH_ENABLE          = 'messages/general/enable';
    const PATH_API_ENDPOINT    = 'messages/general/api_endpoint';
    const PATH_SOCKET_ENDPOINT = 'messages/general/socket_endpoint';
    const PATH_MODE            = 'messages/general/mode';
    const PATH_NAMESPACE       = 'messages/general/namespace';

    /**
     * @return bool
     */
    public function getIsEnable(): bool;

    /**
     * @return string
     */
    public function getApiEndpoint(): string;

    /**
     * @return string
     */
    public function getSocketEndpoint(): string;

    /**
     * @return int
     */
    public function getMode(): int;

    /**
     * @return string
     */
    public function getNamespace(): string;
}
