<?php
namespace jdpowered\SocialBox\Connectors;

interface ConnectorInterface {

    /**
     * Will get a connection object and shall get the value
     *
     * @param  Array $args
     * @return Array
     */
    public function fire($args);

}
