<?php
namespace jdpowered\SocialBox\Connectors;

class PinterestConnector extends BaseConnector {

    /**
     * [fire description]
     *
     * @param  array $args
     * @return array
     */
    public function fire($args)
    {
        /*
            Fetch profile page
         */
        $result = $this->get('https://pinterest.com/' . $args['id']);

        /*
            Check for common errors
         */
        if($this->wasCommonError($result))
        {
            return array('successful' => false);
        }

        /*
            Prepare regular expression and result body
         */
        $regex = '/<meta[^>]*?property="pinterestapp:' . $args['metric'] . '"[^>]*?content="(\d+)"/i';
        $html  = wp_remote_retrieve_body($result);

        /*
            Check for incorrect data
         */
        if(preg_match($regex, $html, $matches) !== 1)
        {
            return array('successful' => false);
        }

        /*
            Return value
         */
        return array(
            'successful' => true,
            'value'      => intval($matches[1]),
        );
    }
}
