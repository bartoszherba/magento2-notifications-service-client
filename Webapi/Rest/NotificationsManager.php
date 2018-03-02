<?php
/**
 * @package  Digibart\Notifications
 * @author Bartosz Herba <bartoszherba@gmail.com>
 */

namespace Digibart\Notifications\Webapi\Rest;

use Digibart\Notifications\Api\ConfigResolverInterface;
use Digibart\Notifications\Api\NotificationsManagerInterface;
use Zend\Http\Client;
use Zend\Http\Client\Adapter\Curl;

/**
 * Class NotificationsManager
 */
class NotificationsManager implements NotificationsManagerInterface
{
    /**
     * @var Client
     */
    private $httpClient;

    /**
     * @var Curl
     */
    private $curlAdapter;

    /**
     * @var ConfigResolverInterface
     */
    private $configResolver;

    /**
     * NotificationsManager constructor.
     *
     * @param Client $httpClient
     * @param Curl $curlAdapter
     * @param ConfigResolverInterface $configResolver
     */
    public function __construct(Client $httpClient, Curl $curlAdapter, ConfigResolverInterface $configResolver)
    {
        $this->httpClient = $httpClient;
        $this->curlAdapter = $curlAdapter;
        $this->configResolver = $configResolver;
    }

    /**
     * @param string $identifier
     * @param string $_id
     *
     * @return string
     */
    public function delete(string $identifier, string $_id): string
    {
        try {
            $this->httpClient->setAdapter($this->curlAdapter);
            $this->httpClient->setUri(sprintf('%s%s', $this->configResolver->getApiEndpoint(), '/v1/message'));
            $this->httpClient->setMethod('DELETE');
            $this->httpClient->setParameterPost(['identifier' => $identifier, '_id' => $_id]);
            $response = $this->httpClient->send();
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }

        return json_encode($response->getBody());
    }

    /**
     * @param string $messages
     *
     * @return string
     */
    public function update(string $messages): string
    {
        $messages = json_decode($messages, true);

        try {
            $this->httpClient->setAdapter($this->curlAdapter);
            $this->httpClient->setUri(sprintf('%s%s', $this->configResolver->getApiEndpoint(), '/v1/message'));
            $this->httpClient->setMethod('PATCH');
            $this->httpClient->setParameterPost(['updates' => $messages]);
            $response = $this->httpClient->send();
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }

        return json_encode($response->getBody());
    }
}
