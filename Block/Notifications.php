<?php
/**
 * @package  Digibart\MessagesNotification
 * @author Bartosz Herba <bartoszherba@gmail.pl>
 */

namespace Digibart\MessagesNotification\Block;

use Digibart\MessagesNotification\Api\ConfigResolverInterface;
use Magento\Customer\Model\Session as CustomerSession;
use Magento\Framework\View\Element\Template;

/**
 * Class Notifications
 */
class Notifications extends Template
{
    /**
     * @var CustomerSession
     */
    protected $customerSession;

    /**
     * @var ConfigResolverInterface
     */
    protected $configResolver;

    /**
     * @var int
     */
    protected $defaultTimeout = 10000;

    /**
     * @var int
     */
    protected $defaultFadeOutTime = 500;

    /**
     * Notifications constructor.
     *
     * @param Template\Context $context
     * @param CustomerSession $customerSession
     * @param ConfigResolverInterface $configResolver
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        CustomerSession $customerSession,
        ConfigResolverInterface $configResolver,
        array $data = []
    ) {
        $this->customerSession = $customerSession;
        $this->configResolver = $configResolver;

        parent::__construct($context, $data);
    }

    /**
     *
     * @return bool
     */
    public function isLoggedIn(): bool
    {
        return $this->customerSession->isLoggedIn();
    }

    /**
     * @return int
     */
    public function getCustomerId(): int
    {
        return (int) $this->customerSession->getCustomerId();
    }

    /**
     * @return string
     */
    public function getServiceEndpoint(): string
    {
        return $this->configResolver->getServiceEndpoint();
    }

    /**
     * @return bool
     */
    public function isModuleEnabled(): bool
    {
        return $this->configResolver->getIsEnable();
    }

    /**
     * @return bool
     */
    public function getIsAlwaysKeepMessage(): bool
    {
        return $this->configResolver->getIsAlwaysKeepMessage();
    }

    /**
     * @return string
     */
    public function getJsonOptions(): string
    {
        return json_encode(
            [
                'endpoint'             => $this->getServiceEndpoint(),
                'isAlwaysKeepMessages' => $this->getIsAlwaysKeepMessage(),
                'timeout'              => $this->_data['timeout'] ?? $this->defaultTimeout,
                'fadeOutTime'          => $this->_data['fadeOutTime'] ?? $this->defaultFadeOutTime,
            ]
        );
    }
}
