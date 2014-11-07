<?php
namespace jdpowered\SocialBox\Connectors;

use jdpowered\SocialBox\Exceptions\MalformedDataException;

class PinterestConnector extends BaseConnector implements ConnectorInterface {

    /**
     * [fire description]
     *
     * @param  array $args
     * @return array
     */
    public function fire()
    {
        /*
            Fetch profile page
         */
        $result = $this->get('https://pinterest.com/' . $this->args['id']);

        /*
            Check for common errors
         */
        $this->checkForCommonErrors($result);

        /*
            Prepare regular expression and result body
         */
        $regex = '/<meta[^>]*?property="pinterestapp:' . $this->args['metric'] . '"[^>]*?content="(\d+)"/i';
        $html  = wp_remote_retrieve_body($result);

        /*
            Check for incorrect data
         */
        if (preg_match($regex, $html, $matches) !== 1) {
            throw new MalformedDataException($html);
        }

        /*
            Return value
         */
        return intval($matches[1]);
    }
}
