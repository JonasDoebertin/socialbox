<?php if(!defined('ABSPATH')) die('Direct access is not allowed.');


/*
 * SocialBox 1.7.0
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
            Upgradeing to 1.6.0
            Inject the default values for the newly added metrics.
         */
        if($this->lastVersionLowerThan('1.6.0'))
        {
            $this->do160Upgrade();
        }

        /*
            Upgradeing to 1.7.0
            Inject the default values for the newly added metrics.
         */
        if($this->lastVersionLowerThan('1.7.0'))
        {
            $this->do170Upgrade();
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
        $this->setDefaultWidgetMetrics($metrics);
        $this->setDefaultCacheMetrics($metrics);
    }

    /**
     * [setDefaultWidgetMetrics description]
     *
     * @param array $metrics
     */
    protected function setDefaultWidgetMetrics($metrics)
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

            /* Loop through all metrics that shall be set */
            foreach($metrics as $network => $metric)
            {
                /* If the metric is not set or is empty... */
                if(!isset($widget[$network . '_metric']) or empty($widget[$network . '_metric']))
                {
                    /* ...set default value. */
                    $widget[$network . '_metric'] = $metric;
                }
            }
        }

        /* Resave updated widget instances */
        update_option('widget_socialbox', $widgets);
    }

    /**
     * [setDefaultCacheMetrics description]
     *
     * @param array $metrics
     */
    protected function setDefaultCacheMetrics($metrics)
    {
        /* Get cache from database */
        $cache = get_option('socialbox_cache', array());
        if(!is_array($cache))
            $cache = array();

        /* Loop through all available networks */
        foreach($cache as &$item)
        {
            /* Skip if we don't have a metric to set for this items network */
            if(!isset($metrics[$item['network']]))
                continue;

            /* If the metric is not set or is empty... */
            if(!isset($item['metric']) or empty($item['metric']))
            {
                /* ...set default value. */
                $item['metric'] = $metrics[$item['network']];
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
