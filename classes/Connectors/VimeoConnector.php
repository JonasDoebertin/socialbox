<?php
namespace jdpowered\SocialBox\Connectors;

class VimeoConnector extends BaseConnector implements ConnectorInterface {

    /**
     * [fire description]
     *
     * @param  array $args
     * @return array
     */
    public function fire()
    {
        /*
            Fetch data from Vimeo API
         */
        $result = $this->get(sprintf('http://vimeo.com/api/v2/channel/%s/info.json', $this->args['id']));

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
        if (is_null($data) or ! isset($data->{$this->args['metric']})) {
            throw new MalformedDataException($data);
        }

        /*
            Return value
         */
        return $data->{$this->args['metric']};
    }
}
