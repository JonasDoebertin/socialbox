<?php
namespace jdpowered\SocialBox\Connectors;

class FacebookConnector extends BaseConnector implements ConnectorInterface {

    /**
     * [fire description]
     *
     * @param  array $args
     * @return array
     */
    public function fire()
    {
        /*
            Extract data center from api key
         */
        $datacenter = 'us1';
        if(strstr($this->args['api_key'], '-'))
        {
            list($key, $datacenter) = explode('-', $this->args['api_key'], 2);
            if( ! $datacenter)
                $datacenter = 'us1';
        }

        /*
            Build data object
         */
        $data = array(
            'apikey' => $this->args['api_key'],
            'filters' => array(
                'list_id' => $this->args['id'],
            ),
            'limit' => 1,
        );

        /*
            Fetch data from MailChimp API v2.0
         */
        $result = $this->post(sprintf('https://%s.api.mailchimp.com/2.0/lists/list.json', $datacenter), $data);

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
        if (is_null($data) or !isset($data->data[0]->stats->member_count)) {
            throw new MalformedDataException($data);
        }

        /*
            Return value
         */
        return $data->data[0]->stats->member_count;
    }
}
