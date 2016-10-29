<?php
/*

Plugin Name: Social Feeder

Plugin URI: http://www.10quality.com

Description: Fully customizable social media feeds plugin. Includes [ Widget ] Integrates with [ Facebook, Twitter and Instagram ].

Version: 0.7.3

Author: 10Quality

Author URI: http://www.10quality.com

License: 10Quality IP License

Copyright (c) 2016 10Quality - http://www.10quality.com

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"),
the rights to use the software as a wordpress plugin; It is prohibited and therefore
limited the rights to modify, merge, publish, distribute, sublicense, and/or sell copies of the Software,
subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
*/

require_once( plugin_dir_path( __FILE__ ) . 'boot/bootstrap.php' );

/**
 * Plugin global functions file.
 *
 * @author Alejandro Mostajo <http://about.me/amostajo>
 * @copyright 10Quality <http://www.10quality.com>
 * @license copyright
 * @package SocialFeeder
 * @version 1.0.2
 */

if ( ! function_exists( 'get_tweet_url' ) ) {
    /**
     * Returns twitter URL based on ID.
     * @since 1.0.0
     *
     * @param string $ID Tweet ID.
     *
     * @return string
     */
    function get_tweet_url( $ID )
    {
        global $socialfeeder;
        return $socialfeeder->get_tweet_url( $ID );
    }
}

if ( ! function_exists( 'get_social_feeder' ) ) {
    /**
     * Returns cached SocialFeeder model.
     * @since 1.0.1
     *
     * @return mixed
     */
    function get_social_feeder()
    {
        global $socialfeeder;
        return $socialfeeder->get_model();
    }
}

if ( ! function_exists( 'get_facebook_url' ) ) {
    /**
     * Returns Facebook URL based on a Facebook data ID.
     * @since 1.0.2
     *
     * @param string $ID Facebook data ID.
     *
     * @return string
     */
    function get_facebook_url( $ID )
    {
        global $socialfeeder;
        return $socialfeeder->get_facebook_url( $ID );
    }
}
   