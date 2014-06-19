<?php
namespace jdpowered\SocialBox\Connectors;

class ForrstConnector extends BaseConnector {

    /**
     * [fire description]
     *
     * @param  array $args
     * @return array
     */
    public function fire($args)
    {
        /*
            Fetch data from Forrst API
         */
        $result = $this->get('https://forrst.com/api/v2/users/info?username=' . $args['id']);

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
        if(is_null($data) or ! isset($data->resp->typecast_followers)){
            return array('successful' => false);
        }

        /*
            Return value
         */
        return array(
            'successful' => true,
            'value'      => $data->resp->typecast_followers,
    }
}
