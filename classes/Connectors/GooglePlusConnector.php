<?php
namespace jdpowered\SocialBox\Connectors;

use jdpowered\SocialBox\Exceptions\MalformedDataException;

class GooglePlusConnector extends BaseConnector implements ConnectorInterface {

    /**
     * [fire description]
     *
     * @param  array $args
     * @return array
     */
    public function fire()
    {
        /*
            Fetch data from Google+ API
         */
        $result = $this->get(sprintf('https://www.googleapis.com/plus/v1/people/%s?key=%s', $this->args['id'], $this->args['api_key']));

        /*
            Check for common errors
         */
        $this->checkForCommonErrors($result);

        /* Decode response */
        $data = json_decode(wp_remote_retrieve_body($result));

        /* Check for incorrect data */
        if (isset($data->error) or !isset($data->circledByCount)) {
            throw new MalformedDataException($data);
        }

        /* Return value */
        return $data->circledByCount;
    }
}
