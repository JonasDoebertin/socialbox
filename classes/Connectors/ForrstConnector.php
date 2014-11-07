<?php
namespace jdpowered\SocialBox\Connectors;

use jdpowered\SocialBox\Exceptions\MalformedDataException;

class ForrstConnector extends BaseConnector implements ConnectorInterface {

    /**
     * [fire description]
     *
     * @param  array $args
     * @return array
     */
    public function fire()
    {
        /*
            Fetch data from Forrst API
         */
        $result = $this->get('https://forrst.com/api/v2/users/info?username=' . $this->args['id']);

        /*
            Check for common errors
         */
        $this->checkForCommonErrors($result);

        /*
            Decode response
         */
        $data = json_decode(wp_remote_retrieve_body($result));

        /*
            Check for incorrect data
         */
        if (is_null($data) or ! isset($data->resp->typecast_followers)){
            throw new MalformedDataException($data);
        }

        /*
            Return value
         */
        return $data->resp->typecast_followers;
    }
}
