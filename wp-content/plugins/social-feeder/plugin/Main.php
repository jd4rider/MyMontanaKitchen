<?php

namespace SocialFeeder;

use SocialFeeder\Models\SocialFeeder;
use Amostajo\WPPluginCore\Plugin as Plugin;
use Amostajo\WPPluginCore\Cache;

/**
 * Main bridge class between WP and Plugin.
 *
 * @author Alejandro Mostajo <http://about.me/amostajo>
 * @copyright 10Quality <http://www.10quality.com>
 * @license copyright
 * @package SocialFeeder
 * @version 1.0.3
 */
class Main extends Plugin
{
    /**
     * Admin menu ID.
     * @since 1.0.0
     * @var string
     */
    const ADMIN_MENU_SETTINGS = 'social-feeder-settings';

    /**
     * Public hooks.
     * @since 1.0.0
     * @since 1.0.3 New core support.
     */
    public function init()
    {
        $this->add_widget( 'SocialFeederWidget' );
        $this->add_action( 'wp_enqueue_scripts', 'AdminController@enqueue' );
    }

    /**
     * Admin hooks.
     * @since 1.0.0
     * @since 1.0.2 Config now passed to controller.
     * @since 1.0.3 New core support.
     */
    public function on_admin()
    {
        $this->add_action( 'admin_init', 'AuthController@start' );
        $this->add_action( 'admin_menu', 'AdminController@menu', [ $this->config ], 10 );
    }

    /**
     * Instagram callback.
     * @since 1.0.0
     */
    public function callback_instagram()
    {
        return $this->mvc->action( 'AuthController@callback_instagram' );
    }

    /**
     * Returns twitter URL based on ID.
     * @since 1.0.0
     *
     * @param string $ID Tweet ID.
     *
     * @return string
     */
    public function get_tweet_url( $ID )
    {
        return sprintf( $this->config->get( 'twitter.link' ), $ID );
    }

    /**
     * Returns facebook post URL based on ID.
     * @since 1.0.2
     *
     * @param string $ID Post ID.
     *
     * @return string
     */
    public function get_facebook_url( $ID )
    {
        return sprintf( $this->config->get( 'facebook.link' ), $ID );
    }

    /**
     * Returns cached SocialFeeder model.
     * @since 1.0.1
     *
     * @return mixed
     */
    public function get_model()
    {
        return Cache::remember(
            'socialfeeder',
            43200,
            function () {
                return SocialFeeder::find();
            }
        );;
    }
}