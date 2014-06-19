<?php
namespace jdpowered\SocialBox\Connectors;

class DribbbleConnector extends BaseConnector {

    /**
     * [fire description]
     *
     * @param  array $args
     * @return array
     */
    public function fire($args)
    {
        /*
            Fetch data from Dribbble API
         */
        $result = $this->get('http://api.dribbble.com/players/' . $args['id']);

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
        if(is_null($data) or ! isset($data->{$args['metric']}))
        {
            return array('successful' => false);
        }

        /*
            Return value
         */
        return array(
            'successful' => true,
            'value'      => $data->{$args['metric']},
        );
    }
}
