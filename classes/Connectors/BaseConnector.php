<?php

namespace jdpowered\SocialBox\Connectors;

abstract class BaseConnector {

    abstract public function fire($args){}

    /**
     * [wasCommonError description]
     *
     * @param array $result
     * @return bool
     */
    protected function wasCommonError($result)
    {
        return is_wp_error($result) or (wp_remote_retrieve_response_code($result) != 200);
    }

    /**
     * [getRequestArgs description]
     *
     * @param string $body = null
     */
    protected function getRequestArgs($body = null)
    {
        return array(
            'sslverify'  => ! \JD_SocialBoxHelper::getOption('disable_ssl'),
            'user-agent' => sprintf('WordPress/%s; SocialBox/%s; %s', get_bloginfo('version'), \JD_SOCIALBOX_VERSION, get_bloginfo('url')),
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
        return wp_remote_get($url, self::getRequestArgs());
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
        return wp_remote_post($url, self::getRequestArgs($body));
    }

}
