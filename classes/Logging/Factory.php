<?php
namespace jdpowered\SocialBox\Logging;

class Factory {

    public static function make()
    {
        return new Log('socialbox_log', 25);
    }

}
