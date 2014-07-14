<?php
namespace jdpowered\SocialBox\Connectors;

use jdpowered\SocialBox\Exceptions\HttpErrorException;

class FacebookConnector extends BaseConnector implements ConnectorInterface {

    /**
     * [fire description]
     *
     * @param  array $args
     * @return array
     */
    public function fire()
    {
        /*
            Fetch data from Graph API
         */
        $result = $this->get('https://graph.facebook.com/' . $this->args['id']);

        /* TODO: Facebook Graph API v2.0 */

        /*
            Check for common errors
         */
        $this->checkForCommonErrors($result);

        /*
            Decode response
         */
        $data = json_decode(wp_remote_retrieve_body($result));

        /*
            Check for invalid data
         */
        if(isset($data->error) or ! isset($data->{$this->args['metric']})) {
            throw new MalformedDataException($data);
        }

        /*
            Return value
         */
        return $data->{$this->args['metric']};
    }
}
