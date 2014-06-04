<?php if(!defined('ABSPATH')) die('Direct access is not allowed.');


/*
 * SocialBox 1.6.3
 * Copyright by Jonas Döbertin
 * Available only at CodeCanyon: http://codecanyon.net/item/socialbox-social-wordpress-widget/627127
 */


class JD_SocialBoxTranslator{

    /**
     * Get the translatable name of a metric
     *
     * @param Array $item
     * @return string
     */
    public function translateMetric($item)
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
                        return __('Likes', 'socialbox');

                    case 'checkins':
                        return __('Checkins', 'socialbox');

                    case 'were_here_count':
                        return __('Were Here', 'socialbox');

                    case 'talking_about_count':
                        return __('Talking About', 'socialbox');
                }
                break;

            /*
                Twitter
             */
            case 'twitter':
                switch($item['metric'])
                {
                    case 'followers_count':
                        return __('Followers', 'socialbox');

                    case 'friends_count':
                        return __('Following', 'socialbox');

                    case 'statuses_count':
                        return __('Tweets', 'socialbox');

                    case 'favourites_count':
                        return __('Favorites', 'socisalbox');

                    case 'listed_count':
                        return __('Listed', 'socialbox');
                }
                break;

            /*
                Google+
             */
            case 'googleplus':
                return __('Followers', 'socialbox');

            /*
                Youtube
             */
            case 'youtube':
                switch($item['metric'])
                {
                    case 'subscriberCount':
                        return __('Subscribers', 'socialbox');

                    case 'totalUploadViews':
                        return __('Video Views', 'socialbox');
                }
                break;

            /*
                Vimeo
             */
            case 'vimeo':
                switch($item['metric'])
                {
                    case 'total_subscribers':
                        return __('Subscribers', 'socialbox');

                    case 'total_videos':
                        return __('Videos', 'socialbox');
                }
                break;

            /*
                Instagram
             */
            case 'instagram':
                switch($item['metric'])
                {
                    case 'media':
                        return __('Posts', 'socialbox');

                    case 'followed_by':
                        return __('Followers', 'socialbox');

                    case 'follows':
                        return __('Following', 'socialbox');
                }
                break;

            /*
                Pinterest
             */
            case 'pinterest':
                switch($item['metric'])
                {
                    case 'followers':
                        return __('Followers', 'socialbox');

                    case 'pins':
                        return __('Pins', 'socialbox');

                    case 'boards':
                        return __('Boards', 'socialbox');
                }
                break;

            /*
                SoundCloud
             */
            case 'soundcloud':
                switch($item['metric'])
                {
                    case 'followers_count':
                        return __('Followers', 'socialbox');

                    case 'followings_count':
                        return __('Followings', 'socialbox');

                    case 'public_favorites_count':
                        return __('Favorites', 'socialbox');

                    case 'playlist_count':
                        return __('Playlists', 'socialbox');

                    case 'track_count':
                        return __('Tracks', 'socialbox');
                }
                break;

            /*
                Dribbble
             */
            case 'dribbble':
                switch($item['metric'])
                {
                    case 'followers_count':
                        return __('Followers', 'socialbox');

                    case 'likes_received_count':
                        return __('Likes', 'socialbox');

                    case 'comments_received_count':
                        return __('Comments', 'socialbox');

                    case 'rebounds_received_count':
                        return __('Rebounds', 'socialbox');

                    case 'shots_count':
                        return __('Shots', 'socialbox');
                }
                break;

            /*
                Forrst
             */
            case 'forrst':
                return __('Followers', 'socialbox');

            /*
                GitHub
             */
            case 'github':
                return __('Followers', 'socialbox');

            /*
                MailChimp
             */
            case 'mailchimp':
                return __('Subscribers', 'socialbox');
        }
    }

}
