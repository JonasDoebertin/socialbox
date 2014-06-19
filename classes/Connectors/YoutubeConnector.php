<?php
namespace jdpowered\SocialBox\Connectors;

class YoutubeConnector extends BaseConnector {

    /**
     * [fire description]
     *
     * @param  array $args
     * @return array
     */
    public function fire($args)
    {
        /*
            Fetch data from Youtube API
         */
        $result = $this->get('http://gdata.youtube.com/feeds/api/users/' . $args['id']);

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
        $data = simplexml_load_string(wp_remote_retrieve_body($result));

        /*
            Check for incorrect data
         */
        if(!$data or isset($data->err) or !isset($data->children('http://gdata.youtube.com/schemas/2007')->statistics->attributes()->{$args['metric']}))
        {
            return array('successful' => false);
        }

        /*
            Return value
         */
        return array(
            'successful' => true,
            'value'      => (int) $data->children('http://gdata.youtube.com/schemas/2007')->statistics->attributes()->{$args['metric']},
        );
    }
}
