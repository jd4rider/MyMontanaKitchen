=== Plugin Name ===
Contributors: 10quality
Tags: social media, feed, feeds, social networks, social feed, social feeder, social, twitter, instagram, customize, customizable, widget, social network, facebook
Requires at least: 3.2
Tested up to: 4.5
Stable tag: 0.7.3
License: 10Quality
License URI: http://www.10quality.com

Integrate your social networks with Wordpress using this, fully customizable, Social Media Feed widget.

== Description ==

The **only** fully customizable Social Media feed; designed to let you modify it and stylize it the way you want to.

Current version only supports: Facebook, Twitter and Instagram (more to come...).

**Social Feeder** connects to multiple social network APIs to extract your feed and display it in your Wordpress setup.

Features:

* Display your social media activity in your Wordpress.
* Merge all your social media into one feed or separate them.
* Displays images coming from social networks.
* Internal file cache for speed optimization.
* Fully customizable templates.
* Facebook pages support.
* NO-JS.
* Un-enqueuable styles.
* Follow us link buttons.

== Installation ==

1. Head to your Wordpress Admin Dashboard and click at the options **Plugins** then **Add new**.
2. Search for this plugin usign the search input or if have downloaded the zip file, upload it manually.
3. Activate the plugin through the 'Plugins' screen in WordPress.
4. Configure the plugin at "Settings->Social Feeder".

== Changelog ==

= 0.7.3 =
*Release Date - 23 July 2016*

* Framework and Twitter SDK updated.

= 0.7.2 =
*Release Date - 13 July 2016*

* Session bug fix. [reported](https://wordpress.org/support/topic/facebook-v26-not-working)
* Facebook SDK updated.

= 0.7.1 =
*Release Date - 21 April 2016*

* Framework [Wordpress Development Templates](http://wordpress-dev.evopiru.com/) updated to latest verion.

= 0.7.0 =
*Release Date - 19 April 2016*

* Added Facebook support.
* Styles updated.
* Wordpress.org assets updated.

= 0.6.0 =
*Release Date - 27 March 2016*

* Tested on Wordpress 4.5.

== Screenshots ==

1. Default plugin's widget templat, displaying only Twitter feed (taken from [Amsgames Blog](http://blog.amsgames.com/)).
2. Default plugin's widget templat, displaying a merged feed from Instagram and Twitter.
3. Admin dashboard settings.

== Frequently Asked Questions ==

= Setup? =

Once activated, **Social Feeder** requires an initial setup in which you will need configure each social network connectivity before you can use the widget.

The settings page is located at the **Settings** option in the admin dashboard. Here you can configure general and individual social network settings.

= How to modify the template? =

The **feed** template is located inside the plugin at the following path: **social-feeder/views/plugins/social-feeder/feed.php**

To modify it, simply copy and paste the template inside your **theme**. The template at your theme should be located at: **[your-theme]/views/plugins/social-feeder/feed.php**

You might want to un-check the styles that come with the plugin at the settings page as well, this will prevent from overloading your page with additional and un-used files.

= Which WordPress versions are supported? =

At the time this document was created, we only tested on Wordpress 4.4.1, we believe, based on the software requirements, that any Wordpress version above 3.2 will work.

= Which PHP versions are supported? =

Any greater or equal to **5.4** is supported.

= While developing, got a weird SSL error, what to do? =

This error occurs because your local php configuration is missing the SSL configuration, which is required for certain functionality within the package.

To solve this, follow these steps:

1. Create the **cacert.pem** file somewhere in your machine. Here is one you can [download](http://curl.haxx.se/ca/cacert.pem).
2. Modify your php.ini file and add the following lines at the very bottom (example in Windows, modify the path to point to the cacert.pem file):

[curl]
; A default value for the CURLOPT_CAINFO option. This is required to be an absolute path.
curl.cainfo = "C:\path\to\cacert.pem"

Finally restart your web server and the problem will be solved.

== Who do I thank for all of this? ==

* [Alejandro Mostajo](http://about.me/amostajo)
* [Wordpress Development Templates](http://wordpress-dev.evopiru.com/)
* [James Mallison](https://github.com/J7mbo/twitter-api-php)
* [Galen Grover](https://github.com/galen/PHP-Instagram-API)