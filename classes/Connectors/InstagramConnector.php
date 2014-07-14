<?php
namespace jdpowered\SocialBox\Connectors;

class InstagramConnector extends BaseConnector  implements ConnectorInterface {

    /**
     * [fire description]
     *
     * @param  array $args
     * @return array
     */
    public function fire()
    {
        /*
            Fetch data from Instagram API
         */
        $result = $this->get(sprintf('https://api.instagram.com/v1/users/%s?client_id=%s', $this->args['user_id'], $this->args['client_id']));

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
        if (is_null($data) or !isset($data->data) or !isset($data->data->counts->{$this->args['metric']})) {
            throw new MalformedDataException($data);
        }

        /*
            Return value
         */
        return $data->data->counts->{$this->args['metric']};
    }
}
