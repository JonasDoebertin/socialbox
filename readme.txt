=== Plugin Name ===
Contributors: JonasDoebertin
Tags: socialbox, social networking
Requires at least: 3.6
Tested up to: 4.0
Stable tag: 1.7.3
License: Envato Market
License URI: http://codecanyon.net/licenses

SocialBox – Social Profile Showcase

== Description ==

With SocialBox you get an absolutely easy to use WordPress Plugin which enables you to add a sleek social widget to your WordPress site or blog. It supports several social networks and displays a variety of statistics from several social networks including, but not limited to, the current number of Facebook Page Likes & Checkins, Twitter, Instagram, Pinterest, Dribbble, Forrst & GitHub Followers, YouTube and Vimeo Channel Subscriptions and MailChimp List Subscribers. You can enter sensible default values which will be shown as a fallback if the related APIs are not reachable.

== Installation ==

To install SocialBox, simply follow these steps:

1. Login to your WordPress site and navigate to the admin page "Plugins > Add new".
2. Select "Upload" from the available options (click it).
3. Select the zip file "socialbox-plugin.zip" and click "Install now". WordPress will upload and install the plugin for you.
4. After the installation has finished, click "Activate Plugin" to enable SocialBox.
5. That's it!

== Changelog ==

= Version 1.7.3 =

**Bugfixes**

* Fixed Google+ wrong links
* Re-added missing Google+ icons

**Additional notes**

* Updates language files: en_US

= Version 1.7.2 =

**Enhancements**

* Added automatic plugin updates.

= Version 1.7.1 =

**Bugfixes**

* Added support for Facebook Graph API v2.1.
* Updated language file template.

**Additional Notes**

* SocialBox now let’s you enter an Facebook App ID and the related App Secret. This is optional until April 30th, 2015. Only at this date, changes to the API Socialbox uses will take effect. However, if you want to be on the save side, you should obtain and enter App credentials right now. The help section has been extended accordingly.

= Version 1.7.0 =

**Enhancements**

* Added support for **Google+** and **SoundCloud**. Also, the help section got updated to reflect these additions.
* Added support for some additional metrics: **Youtube Total Video Views** and **Twitter Following, Tweets, Favorites & Listed**. You can find them within their respective dropdown fields.
* Switched to a more robust implementation of the TwitterOAuth and OAuth classes.

**Bugfixes**

* Made sure every network name and every metric are always fully translatable.
* Added new upgrade routines to make plugin updates a lot less error-prone.
* Updated language file template.

**Additional Notes**

* This will be the last regular version to support PHP 5.2. All future version will require PHP 5.3 or above. PHP 5.2 was released back in November 2006 and was maintained and updated until January 2011. This means that it’s now considered an old release that’s no longer supported. Should a new vulnerability be discovered in PHP 5.2, it will remain unfixed.

= Version 1.6.3 =

* Fixed a bug that caused links to Facebook pages to break when a numeric id was used

= Version 1.6.2 =

* Added support for theme addons (stay tuned!)

= Version 1.6.1 =

* Fixed a bug that caused problems fetching Pinterest and Dribbble numbers in some cases

= Version 1.6.0 =

* Added support for Pinterest and MailChimp
* Added additional metrics for Vimeo and Dribbble
* Fixed option to disable SSL Verification
* Optimized cache implementation (less disk space & faster updates)

= Version 1.5.0 =

* Added support for Instagram
* Completely revamped help section
* Added advanced cache debugging options

= Version 1.4.1 =

* Restore compatibility with PHP 5.3

= Version 1.4.0 =

**Important: After updating the plugin please re-setup all your SocialBox widgets!**

* Added an option to choose from Facebook Page Likes, Checkins & Talking About
* Added a more stable way of fetching Twitter followers
* Added Sass/Compass source files
* Fixed a bug that could prevent regular updates of the numbers
* Updated social network icons
* Improved support for WordPress 3.8
* Major plugin code changes and improvements
* Updated language files

= Version 1.3.2 =

* Fixed a bug that caused to display “0” for Twitter users with more then 1k followers

= Version 1.3.1 =

* Fixed a bug that caused to display “0” for all Twitter users

= Version 1.3.0 =

**Important: After updating the plugin please re-save all your SocialBox widgets!**

* Added additional styles
* Added support for GitHub
* Added an option to use compact numbers (8.4K, 23M, ...)
* Added an option to set a forced widget & button width
* Added an options page including a help section and an API error log
* Removed support for Feedburner (Google abandoned Feedburner, please don’t ask ME why)
* Improved caching functionality
* Fixed a bug that could lead to “Invalid Header” messages in certain cases
* Fixed a bug that could lead to too long cron run times and unsuccessful refreshes
* Major plugin code changes and improvements
* Major HTML / CSS improvements
* Documentation overhaul
* Updated localization files

= Version 1.2.1 =

* Fixed a bug that disabled update notifications
* Added correct “alt” attributes to the network images

= Version 1.2.0 =

* Added additional networks: Dribbble, Forrst, Vimeo and Digg
* Added an option to open links in new Windows/Tabs
* Added the ability to change order of networks
* Redesigned Widget options to improve clarity
* Updated localization files
* Minor CSS improvements

= Version 1.1.1 =

* Fixed a bug that could make WP 3.0 & 3.1 stop working after plugin activation in certain situations
* Added support for WordPress 3.3
* Minor CSS improvements

= Version 1.1.0 =

* Added support for YouTube Channels
* Updated localization files

== Upgrade Notice ==

= 1.7.3 =
Google+ related bugfixes.

= 1.7.2 =
Added automatic plugin updates.
