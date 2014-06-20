<?php
namespace jdpowered\SocialBox\Connectors;

class FacebookConnector extends BaseConnector implements ConnectorInterface {

    /**
     * [fire description]
     *
     * @param  array $args
     * @return array
     */
    public function fire($args)
    {
        /*
            Extract data center from api key
         */
        $datacenter = 'us1';
        if(strstr($item['api_key'], '-'))
        {
            list($key, $datacenter) = explode('-', $item['api_key'], 2);
            if( ! $datacenter)
                $datacenter = 'us1';
        }

        /*
            Build data object
         */
        $data = array(
            'apikey' => $item['api_key'],
            'filters' => array(
                'list_id' => $item['id'],
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
        if(is_null($data) or !isset($data->data[0]->stats->member_count))
        {
            return array('successful' => false);
        }

        /*
            Return value
         */
        return array(
            'successful' => true,
            'value'      => $data->data[0]->stats->member_count,
        );
    }
}
