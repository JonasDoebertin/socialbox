<?php
namespace jdpowered\SocialBox\Connectors;

use jdpowered\SocialBox\Exceptions\HttpErrorException;
use jdpowered\SocialBox\Helpers\Helper;

abstract class BaseConnector implements ConnectorInterface{

    /**
     * Connection details and arguments
     *
     * @type array
     */
    protected $args;

    /**
     * Instantiate connector and store connection details and arguments
     */
    public function __construct($args)
    {
        $this->args = $args;
    }

    abstract public function fire();

    /**
     * [wasCommonError description]
     *
     * @param array $result
     * @return bool
     */
    protected function checkForCommonErrors($result)
    {
        if (is_wp_error($result) or (wp_remote_retrieve_response_code($result) != 200)) {
            throw new HttpErrorException($result);
        }
    }

    /**
     * [getRequestArgs description]
     *
     * @param string $body = null
     */
    protected function getRequestArgs($body = null)
    {
        return array(
            'sslverify'  => ! Helper::getOption('disable_ssl'),
            'user-agent' => sprintf('WordPress/%s; SocialBox/%s; %s', get_bloginfo('version'), JD_SOCIALBOX_VERSION, get_bloginfo('url')),
            'body'       => $body,
        );
    }

    /**
     * [get description]
     *
     * @param  string $url
     * @return array
     */
    protected function get($url)
    {
        return wp_remote_get($url, $this->getRequestArgs());
    }

    /**
     * [post description]
     *
     * @param  string $url
     * @param  array  $body = null
     *
     * @return array
     */
    protected function post($url, $body = null)
    {
        return wp_remote_post($url, $this->getRequestArgs($body));
    }

}
