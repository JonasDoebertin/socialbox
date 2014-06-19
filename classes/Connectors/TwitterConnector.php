<?php
namespace jdpowered\SocialBox\Connectors;

use jdpowered\Twitter\Twitter;

class TwitterConnector extends BaseConnector {

    protected $twitter;

    /**
     * [fire description]
     *
     * @param  array $args
     * @return array
     */
    public function fire($args)
    {
        /*
            Instantiate TwitterOAuth API wrapper
         */
        $this->instantiateWrapper($args);

        /*
            Fetch data from API
         */
        $result = $this->get('users/show', array('screen_name' => $args['id'], 'include_entities' => false));

        /*
            Check for http errors
         */
        if($this->lastStatus() != 200)
        {
            return array('successful' => false);
        }

        /* TODO: Implement metric! */

        /*
            Check for incorrect data
         */
        if(is_null($result) or !isset($result->followers_count))
        {
            return array('successful' => false);
        }

        /* Return value */
        return array(
            'successful' => true,
            'value'      => $result->followers_count
        );
    }

    /**
     * [instantiateWrapper description]
     *
     * @param array $args
     */
    protected function instantiateWrapper($args)
    {
        $this->twitter = new Twitter($args['api_key'], $args['api_secret'], $args['access_token'], $args['access_token_secret']);
    }

    /**
     * [get description]
     *
     * @param  string $endpoint
     * @param  array  $args
     * @return object
     */
    protected function get($endpoint, $args)
    {
        return $this->twitter->get($endpoint, $args);
    }
}
