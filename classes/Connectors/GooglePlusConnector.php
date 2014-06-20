<?php
namespace jdpowered\SocialBox\Connectors;

class GooglePlusConnector extends BaseConnector implements ConnectorInterface {

    /**
     * [fire description]
     *
     * @param  array $args
     * @return array
     */
    public function fire($args)
    {
        /*
            Fetch data from Google+ API
         */
        $result = $this->get(sprintf('https://www.googleapis.com/plus/v1/people/%s?key=%s', $args['id'], $args['api_key']));

        /*
            Check for common errors
         */
        if($this->wasCommonError($result))
        {
            return array('successful' => false);
        }

        /* Decode response */
        $data = json_decode(wp_remote_retrieve_body($result));

        /* Check for incorrect data */
        if(isset($data->error) or !isset($data->circledByCount))
        {
            return array('successful' => false);
        }

        /* Return value */
        return array(
            'successful' => true,
            'value'      => $data->circledByCount,
        );
    }
}
