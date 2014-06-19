<?php
namespace jdpowered\SocialBox\Exceptions;

class ConnectorNotFoundException extends \Exception {

    public function __construct($network)
    {
        /*
            Create a helpful message
         */
        $message = sprintf(__('Connector for network type "%s" not found', 'socialbox'), $network);

        /*
            Pass on to parent
         */
        parent::__construct($message);
    }

}
