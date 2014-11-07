<?php
namespace jdpowered\SocialBox\Helpers;

class Translator{

    /**************************************************************************\
    *                                  METRIC                                  *
    \**************************************************************************/

    /**
     * Echo the translatable metric
     *
     * Echo the translatable metric name by providing either an item object
     * or a network and a metric.
     */
    public function metric()
    {
        $args = func_get_args();
        echo call_user_func_array(array($this, 'getMetric'), $args);
    }


    /**
     * Return the translatable metric
     *
     * Get the translatable metric name by providing either an item object
     * or a network and a metric.
     *
     * @return string
     */
    public function getMetric()
    {
        /*
            Interpret argument as an item object if
                - we have only one argument
                - and this argument is an array.
         */
        if((func_num_args() == 1) and is_array($item = func_get_arg(0)))
        {
            return $this->translateMetric($item);
        }

        /*
            Interpret arguments as network and metric if
                - we have two arguments
                - and these two arguments are string.
         */
        if((func_num_args() == 2) and is_string($network = func_get_arg(0)) and is_string($metric = func_get_arg(1)))
        {
            return $this->translateMetric(
                array(
                    'network' => $network,
                    'metric' => $metric
                )
            );
        }
    }


    /**
     * Get the translatable name of a metric
     *
     * @param Array $item
     * @return string
     */
    protected function translateMetric($item)
    {
        switch($item['network'])
        {
            /*
                Facebook
             */
            case 'facebook':
                switch($item['metric'])
                {
                    case 'likes':
                        return _x('Likes', 'Facebook Likes', 'socialbox');

                    case 'checkins':
                        return _x('Checkins', 'Facebook Checkins', 'socialbox');

                    case 'were_here_count':
                        return _x('Were Here', 'Facebook Were Here', 'socialbox');

                    case 'talking_about_count':
                        return _x('Talking About', 'Facebook Talking About', 'socialbox');
                }
                break;

            /*
                Twitter
             */
            case 'twitter':
                switch($item['metric'])
                {
                    case 'followers_count':
                        return _x('Followers', 'Twitter Followers', 'socialbox');

                    case 'friends_count':
                        return _x('Following', 'Twitter Following', 'socialbox');

                    case 'statuses_count':
                        return _x('Tweets', 'Twitter Tweets', 'socialbox');

                    case 'favourites_count':
                        return _x('Favorites', 'Twitter Favorites', 'socisalbox');

                    case 'listed_count':
                        return _x('Listed', 'Twitter Listed', 'socialbox');
                }
                break;

            /*
                Google+
             */
            case 'googleplus':
                return _x('Followers', 'Google+ Followers', 'socialbox');

            /*
                Youtube
             */
            case 'youtube':
                switch($item['metric'])
                {
                    case 'subscriberCount':
                        return _x('Subscribers', 'Youtube Subscribers', 'socialbox');

                    case 'totalUploadViews':
                        return _x('Video Views', 'Youtube Video Views', 'socialbox');
                }
                break;

            /*
                Vimeo
             */
            case 'vimeo':
                switch($item['metric'])
                {
                    case 'total_subscribers':
                        return _x('Subscribers', 'Vimeo Subscribers', 'socialbox');

                    case 'total_videos':
                        return _x('Videos', 'Vimeo Video Views', 'socialbox');
                }
                break;

            /*
                Instagram
             */
            case 'instagram':
                switch($item['metric'])
                {
                    case 'media':
                        return _x('Posts', 'Instagram Posts', 'socialbox');

                    case 'followed_by':
                        return _x('Followers', 'Instagram Followers', 'socialbox');

                    case 'follows':
                        return _x('Following', 'Instagram Follows', 'socialbox');
                }
                break;

            /*
                Pinterest
             */
            case 'pinterest':
                switch($item['metric'])
                {
                    case 'followers':
                        return _x('Followers', 'Pinterest Followers', 'socialbox');

                    case 'pins':
                        return _x('Pins', 'Pinterest Pins', 'socialbox');

                    case 'boards':
                        return _x('Boards', 'Pinterest Boards', 'socialbox');
                }
                break;

            /*
                SoundCloud
             */
            case 'soundcloud':
                switch($item['metric'])
                {
                    case 'followers_count':
                        return _x('Followers', 'SoundCloud Followers', 'socialbox');

                    case 'followings_count':
                        return _x('Following', 'SoundCloud Following', 'socialbox');

                    case 'public_favorites_count':
                        return _x('Favorites', 'SoundCloud Public Favorites', 'socialbox');

                    case 'playlist_count':
                        return _x('Playlists', 'SoundCloud Playlists', 'socialbox');

                    case 'track_count':
                        return _x('Tracks', 'SoundCloud Track Count', 'socialbox');
                }
                break;

            /*
                Dribbble
             */
            case 'dribbble':
                switch($item['metric'])
                {
                    case 'followers_count':
                        return _x('Followers', 'Dribbble Followers', 'socialbox');

                    case 'likes_received_count':
                        return _x('Likes', 'Dribbble Likes', 'socialbox');

                    case 'comments_received_count':
                        return _x('Comments', 'Dribbble Comments', 'socialbox');

                    case 'rebounds_received_count':
                        return _x('Rebounds', 'Dribbble Rebounds', 'socialbox');

                    case 'shots_count':
                        return _x('Shots', 'Dribbble Shots', 'socialbox');
                }
                break;

            /*
                WP Tally
             */
            case 'wptally':
                switch($item['metric'])
                {
                    case 'count':
                        return _x('Plugins', 'WordPress Plugins', 'socialbox');

                    case 'total_downloads':
                        return _x('Downloads', 'WordPress Plugin Downloads', 'socialbox');
                }
                break;

            /*
                Forrst
             */
            case 'forrst':
                return _x('Followers', 'Forrst Followers', 'socialbox');

            /*
                GitHub
             */
            case 'github':
                return _x('Followers', 'GitHub Followers', 'socialbox');

            /*
                MailChimp
             */
            case 'mailchimp':
                return _x('Subscribers', 'MailChimp Subscribers', 'socialbox');
        }
    }





    /**************************************************************************\
    *                               NETWORK NAME                               *
    \**************************************************************************/

    /**
     * Echo the translatable network name
     *
     * Echo the translatable network name by providing either an item object
     * or a network.
     */
    public function network()
    {
        $args = func_get_args();
        echo call_user_func_array(array($this, 'getNetwork'), $args);
    }


    /**
     * Return the translatable network name
     *
     * Get the translatable network name by providing either an item object
     * or a network.
     *
     * @return string
     */
    public function getNetwork()
    {
        /*
            Interpret argument as an item object if
                - we have only one argument
                - and this argument is an array.
         */
        if((func_num_args() == 1) and is_array($item = func_get_arg(0)))
        {
            return $this->translateNetwork($item);
        }

        /*
            Interpret arguments as network if
                - we have one argument
                - and this argument is a string.
         */
        if((func_num_args() == 1) and is_string($network = func_get_arg(0)))
        {
            return $this->translateNetwork(
                array(
                    'network' => $network
                )
            );
        }
    }


    /**
     * Get the translatable name of a network
     *
     * @param Array $item
     * @return string
     */
    protected function translateNetwork($item)
    {
        switch($item['network'])
        {
            case 'facebook':
                return __('Facebook', 'socialbox');

            case 'twitter':
                return __('Twitter', 'socialbox');

            case 'googleplus':
                return __('Google+', 'socialbox');

            case 'youtube':
                return __('YouTube', 'socialbox');

            case 'vimeo':
                return __('Vimeo', 'socialbox');

            case 'instagram':
                return __('Instagram', 'socialbox');

            case 'pinterest':
                return __('Pinterest', 'socialbox');

            case 'soundcloud':
                return __('SoundCloud', 'socialbox');

            case 'dribbble':
                return __('Dribbble', 'socialbox');

            case 'forrst':
                return __('Forrst', 'socialbox');

            case 'github':
                return __('GitHub', 'socialbox');

            case 'mailchimp':
                return __('Newsletter', 'socialbox');

            case 'wptally':
                return __('WordPress Plugin Repository', 'socialbox');
        }
    }
}
