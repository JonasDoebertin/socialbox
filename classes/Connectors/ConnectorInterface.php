<?php
namespace jdpowered\SocialBox\Connectors;

interface ConnectorInterface {

    /**
     * Will get a connection object and shall get the value
     *
     * @return Array
     */
    public function fire();

}
