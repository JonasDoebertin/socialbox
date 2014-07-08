<?php
namespace jdpowered\SocialBox\Updater;

class Factory {

    public static function make()
    {
        return new Updater(JD_SOCIALBOX_VERSION, 'http://example.com', JD_SOCIALBOX_BASENAME, 'socialbox');
    }

}
