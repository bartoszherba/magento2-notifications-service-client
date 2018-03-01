<?php
/**
 * @package  Digibart\MessagesNotification
 * @author Bartosz Herba <bartoszherba@gmail.pl>
 */

namespace Digibart\MessagesNotification\Block;

use Digibart\MessagesNotification\Api\ConfigResolverInterface;
use Digibart\MessagesNotification\Api\IdentifierGeneratorInterface;
use Digibart\MessagesNotification\Config\Source\Mode;
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
     * @var IdentifierGeneratorInterface
     */
    protected $identifierGenerator;

    /**
     * Notifications constructor.
     *
     * @param Template\Context $context
     * @param CustomerSession $customerSession
     * @param ConfigResolverInterface $configResolver
     * @param IdentifierGeneratorInterface $identifierGenerator
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        CustomerSession $customerSession,
        ConfigResolverInterface $configResolver,
        IdentifierGeneratorInterface $identifierGenerator,
        array $data = []
    ) {
        $this->customerSession = $customerSession;
        $this->configResolver = $configResolver;
        $this->identifierGenerator = $identifierGenerator;

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
     * @return string
     */
    public function getIdentifier(): string
    {
        return $this->identifierGenerator->generate($this->customerSession->getCustomerId());
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
     * @return int
     */
    public function getMode(): int
    {
        return $this->configResolver->getMode();
    }

    /**
     * @return bool
     */
    public function isInboxEnabled(): bool
    {
        return ($this->getMode() === Mode::OPT_DEFAULT || $this->getMode() === Mode::OPT_INBOX_ONLY);
    }

    /**
     * @return bool
     */
    public function isNotificationEnabled(): bool
    {
        return ($this->getMode() === Mode::OPT_DEFAULT || $this->getMode() === Mode::OPT_NOTIFICATION_ONLY);
    }

    /**
     * @return string
     */
    public function getJsonOptions(): string
    {
        return json_encode(
            [
                'endpoint'    => $this->getServiceEndpoint(),
                'mode'        => $this->getMode(),
                'timeout'     => $this->_data['timeout'] ?? $this->defaultTimeout,
                'fadeOutTime' => $this->_data['fadeOutTime'] ?? $this->defaultFadeOutTime,
            ]
        );
    }
}
