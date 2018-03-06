<?php
/**
 * @package  Digibart\Notifications
 * @author Bartosz Herba <bartoszherba@gmail.com>
 */

namespace Digibart\Notifications\Config;

use Digibart\Notifications\Api\ConfigResolverInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

/**
 * Class ConfigResolver
 */
class ConfigResolver implements ConfigResolverInterface
{
    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;

    /**
     * ConfigResolver constructor.
     *
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(ScopeConfigInterface $scopeConfig)
    {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * @return bool
     */
    public function getIsEnable(): bool
    {
        return (bool) $this->scopeConfig->getValue(self::PATH_ENABLE, ScopeInterface::SCOPE_STORE);
    }

    /**
     * @return string
     */
    public function getApiEndpoint(): string
    {
        return (string) trim(
            $this->scopeConfig->getValue(self::PATH_API_ENDPOINT, ScopeInterface::SCOPE_STORE),
            '/'
        );
    }

    /**
     * @return string
     */
    public function getSocketEndpoint(): string
    {
        return (string) trim(
            $this->scopeConfig->getValue(self::PATH_SOCKET_ENDPOINT, ScopeInterface::SCOPE_STORE),
            '/'
        );
    }

    /**
     * @return int
     */
    public function getMode(): int
    {
        return (int) $this->scopeConfig->getValue(self::PATH_MODE, ScopeInterface::SCOPE_STORE);
    }

    /**
     * @return string
     */
    public function getNamespace(): string
    {
        return (string) $this->scopeConfig->getValue(self::PATH_NAMESPACE, ScopeInterface::SCOPE_STORE);
    }
}
