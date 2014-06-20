<?php
namespace jdpowered\SocialBox\Connectors;

class InstagramConnector extends BaseConnector  implements ConnectorInterface {

    /**
     * [fire description]
     *
     * @param  array $args
     * @return array
     */
    public function fire($args)
    {
        /*
            Fetch data from Instagram API
         */
        $result = $this->get(sprintf('https://api.instagram.com/v1/users/%s?client_id=%s', $args['user_id'], $args['client_id']));

        /*
            Check for common errors
         */
        if($this->wasCommonError($result))
        {
            return array('successful' => false);
        }

        /*
            Decode response
         */
        $data = json_decode(wp_remote_retrieve_body($result));

        /*
            Check for incorrect data
         */
        if(is_null($data) or !isset($data->data) or !isset($data->data->counts->{$args['metric']}))
        {
            return array('successful' => false);
        }

        /*
            Return value
         */
        return array(
            'successful' => true,
            'value'      => $data->data->counts->{$args['metric']},
        );
    }
}
