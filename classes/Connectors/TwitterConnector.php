<?php
namespace jdpowered\SocialBox\Connectors;

use jdpowered\Twitter\Twitter;

class TwitterConnector extends BaseConnector implements ConnectorInterface {

    /**
     * TWitter API Wrapper class instance
     *
     * @type jdpowered\Twitter\Twitter $twitter
     */
    protected $twitter;

    /**
     * [__construct description]
     *
     * @param  array $args
     *
     * @return jdpowered\SocialBox\Connectors\TwitterConnector
     */
    public function __construct($args)
    {
        /*
            Instantiate TwitterOAuth API wrapper
         */
        $this->instantiateWrapper($args);

        parent::__construct($args);
    }

    /**
     * [fire description]
     *
     * @param  array $args
     * @return array
     */
    public function fire()
    {
        /*
            Fetch data from API
         */
        $result = $this->getFromWrapper('users/show', array('screen_name' => $this->args['id'], 'include_entities' => false));

        /*
            Check for http errors
         */
        if($this->getLastStatusCode() != 200)
        {
            throw new HttpErrorException($result);
        }

        /* TODO: Implement metric! */

        /*
            Check for incorrect data
         */
        if (is_null($result) or !isset($result->followers_count)) {
            throw new MalformedDataException($result);
        }

        /* Return value */
        return $result->followers_count;
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
    protected function getFromWrapper($endpoint, $args)
    {
        return $this->twitter->get($endpoint, $args);
    }

    /**
     * [getLastStatusCode description]
     *
     * @return int
     */
    protected function getLastStatusCode()
    {
        return $this->twitter->getLastStatusCode();
    }
}
