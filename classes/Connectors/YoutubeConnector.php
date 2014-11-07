<?php
namespace jdpowered\SocialBox\Connectors;

use jdpowered\SocialBox\Exceptions\MalformedDataException;

class YoutubeConnector extends BaseConnector implements ConnectorInterface {

    /**
     * [fire description]
     *
     * @param  array $args
     * @return array
     */
    public function fire()
    {
        /*
            Fetch data from Youtube API
         */
        $result = $this->get('http://gdata.youtube.com/feeds/api/users/' . $this->args['id']);

        /*
            Check for common errors
         */
        $this->checkForCommonErrors($result);

        /*
            Decode response
         */
        $data = simplexml_load_string(wp_remote_retrieve_body($result));

        /*
            Check for incorrect data
         */
        if (!$data or isset($data->err) or !isset($data->children('http://gdata.youtube.com/schemas/2007')->statistics->attributes()->{$this->args['metric']})) {
            throw new MalformedDataException($data);
        }

        /*
            Return value
         */
        return (int) $data->children('http://gdata.youtube.com/schemas/2007')->statistics->attributes()->{$this->args['metric']};
    }
}
