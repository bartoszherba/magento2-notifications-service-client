<?php
/**
 * @package  Digibart\Notifications
 * @author Bartosz Herba <bartoszherba@gmail.com>
 */

namespace Digibart\Notifications\Config\Source;

use Magento\Framework\Option\ArrayInterface;

/**
 * Class Mode
 */
class Mode implements ArrayInterface
{
    /**
     * Options values
     */
    const OPT_DEFAULT           = 1;
    const OPT_INBOX_ONLY        = 2;
    const OPT_NOTIFICATION_ONLY = 3;

    /**
     * Return array of options as value-label pairs
     *
     * @return array Format: array(array('value' => '<value>', 'label' => '<label>'), ...)
     */
    public function toOptionArray(): array
    {
        return [
            ['value' => self::OPT_DEFAULT, 'label' => __('Inbox and Notifications')],
            ['value' => self::OPT_INBOX_ONLY, 'label' => __('Inbox Only')],
            ['value' => self::OPT_NOTIFICATION_ONLY, 'label' => __('Notifications Only')],
        ];
    }
}
