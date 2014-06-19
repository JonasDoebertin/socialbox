<?php
namespace jdpowered\SocialBox\Connectors;

class SoundCloudConnector extends BaseConnector {

    /**
     * [fire description]
     *
     * @param  array $args
     * @return array
     */
    public function fire($args)
    {
        /*
            Fetch data from SoundCloud API
         */
        $result = $this->get(sprintf('http://api.soundcloud.com/users/%s.json?client_id=%s', $args['id'], $args['client_id']));

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
        if(is_null($data) or isset($data->errors) or ! isset($data->{$args['metric']}))
        {
            return array('successful' => false);
        }

        /*
            Return value
         */
        return array(
            'successful' => true,
            'value'      => $data->{$args['metric']}
        );
    }
}
