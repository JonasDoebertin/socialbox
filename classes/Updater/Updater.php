<?php
namespace jdpowered\SocialBox\Updater;

class Updater {

    public function __construct($currentVersion, $remote, $basename, $slug)
    {
        $this->currentVersion = $currentVersion;
        $this->remote = $remote;
        $this->basename = $basename;
        $this->slug = $slug;

        /*
            Inject our own update information whenever WordPress checks for
            wordpress.org plugin updates.
         */
        add_filter('pre_set_site_transient_update_plugins', array(&$this, 'injectUpdateData'));

        /*
            Blah.
         */
        add_filter('plugins_api', array(&$this, 'injectUpdateInformation'), 10, 3);
    }

    public function injectUpdateData($transient)
    {
        if(empty($transient->checked))
        {
            return $transient;
        }

        $info = new \stdClass;
        $info->slug = $this->slug;
        $info->new_version = '2.1.3';
        $info->url = 'http://example.com/file.zip';
        $info->package = 'http://example.com/file.zip';

        $transient->response[$this->basename] = $info;

        return $transient;
    }

    public function injectUpdateInformation($false, $action, $args)
    {
        if($args->slug == $this->slug)
        {
            $information = $this->getRemote_information();
            return $information;
        }

        return $false;
    }

}
