<?php
/**
 * @package  Digibart\Notifications
 * @author Bartosz Herba <bartoszherba@gmail.com>
 */

namespace Digibart\Notifications\Api;

/**
 * Interface NotificationsManagerInterface
 *
 * @api
 */
interface NotificationsManagerInterface
{
    /**
     * @param string $identifier
     * @param string $_id
     *
     * @return string
     */
    public function delete(string $identifier, string $_id): string;

    /**
     * @param string $messages
     *
     * @return string
     */
    public function update(string $messages): string;
}
