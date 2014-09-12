<?php if(!defined('ABSPATH')) die('Direct access is not allowed.');


/*
 * SocialBox 1.7.1
 * Copyright by Jonas Döbertin
 * Available only at CodeCanyon: http://codecanyon.net/item/socialbox-social-wordpress-widget/627127
 */


class JD_SocialBoxUpgrader{

    /**
     * @var
     */
    protected $lastVersion;





    /**************************************************************************\
    *                               CONSTRUCTOR                                *
    \**************************************************************************/

    /**
     * [__construct description]
     *
     * @return JD_SocialBoxUpgrader
     */
    public function __construct()
    {
        /*
            Find the last used version
         */
        $this->lastVersion = $this->findLastVersion();

        /*
            Set current version
         */
        $this->currentVersion = JD_SOCIALBOX_VERSION;
    }





    /**************************************************************************\
    *                               MAIN RUNNER                                *
    \**************************************************************************/

    /**
     * [run description]
     */
    public function run()
    {
        /*
            Upgrading to 1.4.0
            Remove all garbage that might be remaining from older versions (this
            includes old cron schedules and options). This will cause a fresh
            installation that has to be set up from the beginning.
         */
        if($this->lastVersionLowerThan('1.4.0'))
        {
            $this->do140Cleanup();
            // $this->do140Upgrade();
        }

        /*
            Upgrading to 1.6.0
            Inject the default values for the newly added metrics.
         */
        if($this->lastVersionLowerThan('1.6.0'))
        {
            $this->do160Upgrade();
        }

        /*
            Upgrading to 1.7.0
            Inject the default values for the newly added metrics.
         */
        if($this->lastVersionLowerThan('1.7.0'))
        {
            $this->do170Upgrade();
        }

        /*
            Upgrading to 1.7.1
            Inject the default values for the newly added Facebook app credentials
         */
        if($this->lastVersionLowerThan('1.7.1'))
        {
            $this->do171Upgrade();
        }

        /*
            Upgrading to 1.7.2
            Remove old plugin update cron schedule
         */
        if($this->lastVersionLowerThan('1.7.2'))
        {
            $this->do172Cleanup();
        }


        /*
            Always
            Remove all previously scheduled hooks. This helps to prevent
            duplicate schedules caused by users omitting to deactivate the
            plugin before updating.
         */
        $this->doGeneralCleanup();


        /*
            Last step: Save current version for future updates
         */
        $this->setLastVersion($this->currentVersion);
    }





    /**************************************************************************\
    *                             CLEANUP ROUTINES                             *
    \**************************************************************************/

    /**
     * [doVintageCleanup description]
     */
    protected function do140Cleanup()
    {
        /*
            First step:
            Remove all old options.
         */
        delete_option('widget_socialbox');
        delete_option('socialbox_cache');
        delete_option('socialbox_update');
        delete_option('socialbox_options');
        delete_option('socialbox_updateinfo');

        /*
            Second step:
            Remove all old cron schedules.
         */
        wp_clear_scheduled_hook('socialbox_update_cache');
		wp_clear_scheduled_hook('socialbox_check_for_update');
    }

    /**
     * [do160Upgrade description]
     */
    protected function do160Upgrade()
    {
        /*
            Only step:
            Set the default Vimeo and Dribbble metrics for all widgets and cache
            items.
         */
        $this->setDefaultMetrics(array(
            'vimeo'    => 'total_subscribers',
            'dribbble' => 'followers_count'
        ));
    }

    /**
     * [do170Upgrade description]
     */
    protected function do170Upgrade()
    {
        /*
            Only step:
            Set the default Vimeo and Dribbble metrics for all widgets and cache
            items.
         */
        $this->setDefaultMetrics(array(
            'youtube' => 'subscriberCount',
            'twitter' => 'followers_count'
        ));
    }

    /**
     * [do171Upgrade description]
     */
    protected function do171Upgrade()
    {
        /*
            Only step:
            Set the default Facebook App ID and secret for all widgets and cache
            items.
         */
        $this->setDefaultValues(array(
            'facebook' => array(
                'app_id'     => '',
                'app_secret' => '',
            ),
        ));
    }

    /**
     * [do172Cleanup description]
     */
    protected function do172Cleanup()
    {
        /*
            First step:
            Remove all old options.
         */
        delete_option('socialbox_update');

        /*
            Second step:
            Remove all old cron schedules.
         */
        wp_clear_scheduled_hook('socialbox_update_plugin');
    }

    /**
     * [doGeneralCleanup description]
     */
    protected function doGeneralCleanup()
    {
        /*
            Remove all previously scheduled events.
         */
        wp_clear_scheduled_hook('socialbox_update_cache');
        wp_clear_scheduled_hook('socialbox_update_plugin');
        wp_clear_scheduled_hook('socialbox_check_for_update');
    }





    /**************************************************************************\
    *                              METRIC HELPERS                              *
    \**************************************************************************/

    /**
     * [setDefaultMetrics description]
     *
     * @param array $metrics
     */
    protected function setDefaultMetrics($metrics)
    {
        $values = array();
        foreach($metrics as $network => $value)
        {
            $values[$network] = array('metric', $value);
        }

        $this->setDefaultValues($values);
    }

    /**
     * [setDefaultValues description]
     *
     * @param array $values
     */
    protected function setDefaultValues($values)
    {
        $this->setDefaultWidgetValues($values);
        $this->setDefaultCacheValues($values);
    }

    /**
     * [setDefaultWidgetValues description]
     *
     * @param array $values
     */
    protected function setDefaultWidgetValues($values)
    {
        /* Get all SocialBox widget instances */
        $widgets = get_option('widget_socialbox', array());
        if(!is_array($widgets))
            $widgets = array();

        /* Loop through all SocialBox widgets */
        foreach($widgets as &$widget)
        {
            /* Skip non-array entries */
            if(!is_array($widget))
                continue;

            /* Loop through all values that shall be set */
            foreach($values as $network => $options)
            {
                foreach($options as $option => $value)
                {
                    if( ! isset($widget[$network . '_' . $option]) or empty($widget[$network . '_' . $option]))
                    {
                        $widget[$network . '_' . $option] = $value;
                    }
                }
            }
        }

        /* Resave updated widget instances */
        update_option('widget_socialbox', $widgets);
    }

    /**
     * [setDefaultCacheValues description]
     *
     * @param array $values
     */
    protected function setDefaultCacheValues($values)
    {
        /* Get cache from database */
        $cache = get_option('socialbox_cache', array());
        if(!is_array($cache))
            $cache = array();

        /* Loop through all available networks */
        foreach($cache as &$item)
        {
            /* Skip if we don't have a value to set for this items network */
            if( ! array_key_exists($item['network'], $values))
                continue;

            /* Loop through all values that shall be set */
            foreach($values[$item['network']] as $key => $value)
            {
                /* If the value is not set or is empty... */
                if( ! isset($item[$key]) or empty($item[$key]))
                {
                    /* ...set default value. */
                    $item[$key] = $value;
                }
            }
        }

        update_option('socialbox_cache', $cache);
    }




    /**************************************************************************\
    *                      VERSION RELATED FUNCTIONALITY                       *
    \**************************************************************************/

    /**
     * [lastVersionLowerThan description]
     *
     * @param string $testVersion
     * @return bool
     */
    protected function lastVersionLowerThan($testVersion)
    {
        return version_compare($this->lastVersion, $testVersion, '<');
    }

    /**
     * [findLastVersion description]
     *
     * @return string
     */
    protected function findLastVersion()
    {
        return get_option('socialbox_last_version', '0');
    }

    /**
     * [setLastVersion description]
     *
     * @param string
     */
    protected function setLastVersion($version)
    {
        update_option('socialbox_last_version', $version);
    }
}
