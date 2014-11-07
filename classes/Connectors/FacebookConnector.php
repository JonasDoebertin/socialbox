<?php
namespace jdpowered\SocialBox\Connectors;

use jdpowered\SocialBox\Exceptions\HttpErrorException;
use jdpowered\SocialBox\Exceptions\MalformedDataException;

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
			Check if an App ID and an App Secret are set
		 */
		if(isset($this->args['app_id']) and ! empty($this->args['app_id']) and
		   isset($this->args['app_secret']) and ! empty($this->args['app_secret']))
		{
			/*
				If yes, use Facebook API v2.0
			 */
            $result = $this->get(sprintf('https://graph.facebook.com/v2.1/%s?access_token=%s|%s', $item['id'], $item['app_id'], $item['app_secret']));
		}
		else
		{
			/*
				If no, use Facebook API v1.0
			*/
			$result = $this->get('https://graph.facebook.com/' . $this->args['id']);
		}

        /*
            Check for common errors
         */
        $this->checkForCommonErrors($result);

        /*
            Decode response
         */
        $data = json_decode(wp_remote_retrieve_body($result));

        /*
            Check for invalid data
         */
        if(isset($data->error) or ! isset($data->{$this->args['metric']})) {
            throw new MalformedDataException($data);
        }

        /*
            Return value
         */
        return $data->{$this->args['metric']};
    }
}
