<?php
/**
 * @package  Digibart\MessagesNotification
 * @author Bartosz Herba <bartoszherba@gmail.com>
 */

namespace Digibart\MessagesNotification\Config;

use Digibart\MessagesNotification\Api\ConfigResolverInterface;
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
    public function getServiceEndpoint(): string
    {
        return (string) trim(
            $this->scopeConfig->getValue(self::PATH_SERVICE_ENDPOINT, ScopeInterface::SCOPE_STORE),
            '/'
        );
    }

    /**
     * @return bool
     */
    public function getMode(): int
    {
        return (int) $this->scopeConfig->getValue(self::PATH_MODE, ScopeInterface::SCOPE_STORE);
    }
}
