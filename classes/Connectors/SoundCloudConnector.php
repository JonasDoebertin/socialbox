<?php
namespace jdpowered\SocialBox\Connectors;

class SoundCloudConnector extends BaseConnector implements ConnectorInterface {

    /**
     * [fire description]
     *
     * @param  array $args
     * @return array
     */
    public function fire()
    {
        /*
            Fetch data from SoundCloud API
         */
        $result = $this->get(sprintf('http://api.soundcloud.com/users/%s.json?client_id=%s', $this->args['id'], $this->args['client_id']));

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
        if (is_null($data) or isset($data->errors) or ! isset($data->{$this->args['metric']})) {
            throw new MalformedDataException($data);
        }

        /*
            Return value
         */
        return $data->{$this->args['metric']};
    }
}
