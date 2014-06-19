<?php
namespace jdpowered\SocialBox\Connectors;

use jdpowered\SocialBox\Exceptions\ConnectorNotFoundException;

class Factory {

    public static function create($item)
    {
        /*
            Extract network to simplify following statements
         */
        $network = $item['network'];
        $connector = "jdpowered\\SocialBox\\Connectors\\{$network}Connector";

        /*
            Throw an exception if no related connector class exists
         */
        if( ! class_exists($connector))
        {
            throw new ConnectorNotFoundException($network);
        }

        /*
            Create new connector object
         */
        return new $connector;
    }

}
