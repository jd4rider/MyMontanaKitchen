<?php

namespace SocialFeeder\Controllers;

use stdClass;
use SocialFeeder\Models\SocialFeeder;
use SocialFeeder\Main as Plugin;
use Amostajo\LightweightMVC\Controller;
use Amostajo\LightweightMVC\Request;
use Amostajo\WPPluginCore\Log;
use Amostajo\WPPluginCore\Cache;

/**
 * Admin configuration functionality.
 *
 * @author Alejandro Mostajo <http://about.me/amostajo>
 * @copyright 10Quality <http://www.10quality.com>
 * @license copyright
 * @package TenQuality\SocialFeeder
 * @version 1.0.2
 */
class AdminController extends Controller
{
    /**
     * Plugins configuration.
     * @since 1.0.1
     * @var object
     */
    protected $config;

    /**
     * Registers admin menus.
     * @since 1.0.0
     * @since 1.0.1 Added config parameter.
     *
     * @param object $config Plugin's configuration.
     */
    public function menu( $config )
    {
        $this->config = $config;
        add_submenu_page(
            'options-general.php',
            'Social Feeder Settings',
            'Social Feeder',
            'manage_options',
            Plugin::ADMIN_MENU_SETTINGS,
            [ &$this, 'view_settings' ]
        );
    }

    /**
     * Displays admin settings.
     * @since 1.0.0
     * @since 1.0.1 Added config parameter.
     */
    public function view_settings()
    {
        $socialFeeder = SocialFeeder::find();
        $this->view->show( 'plugins.social-feeder.admin.settings', [
            'notice'        => $this->save( $socialFeeder ),
            'error'         => Request::input( 'error' ),
            'tab'           => Request::input( 'tab', 'general' ),
            'tabs'          => [
                                'general'   => 'General',
                                'facebook'  => 'Facebook',
                                'twitter'   => 'Twitter',
                                'instagram' => 'Instagram',
                            ],
            'view'          => $this->view,
            'socialFeeder'  => $socialFeeder,
            'config'        => $this->config,
        ] );
    }

    /**
     * Saves settings.
     * Returns flag indicating success operation
     * @since 1.0.0
     * @since 1.0.1 Added facebook.
     * @since 1.0.2 Added Snapchat.
     *
     * @param object $socialFeeder Social Feeder model
     */
    protected function save( &$model )
    {
        $notice = Request::input( 'notice' );
        // Check action
        if ( !empty( $notice ) ) return $notice;
        // Save form
        if ( $_POST ) {
            try {
                $redirect_url = null;
                
                $model->frequency = Request::input( 'frequency', 60 );
                $model->date_format = Request::input( 'date_format', 'F j, Y' );
                $model->merge = Request::input( 'merge', 0 );
                $model->limit = Request::input( 'limit', 4 );
                $model->enqueue_styles = Request::input( 'enqueue_styles', 0 );
                $model->follow_us = Request::input( 'follow_us', 0 );
                $model->security_key = Request::input( 'security_key', uniqid( '', true ) );

                if ( !$model->is_facebook_setup )
                    $model->facebook = [];

                $check = $model->facebook;

                $model->facebook['enabled'] = Request::input( 'facebook_enabled', 0 );
                $model->facebook['app_id'] = Request::input( 'facebook_app_id' );
                $model->facebook['app_secret'] = Request::input( 'facebook_app_secret' );
                $model->facebook['api_version'] = Request::input( 'facebook_api_version', 'v2.5' );
                $model->facebook['redirect_url'] = admin_url( 'index.php?trigger=facebook-callback' );
                $model->facebook['follow_url'] = Request::input( 'facebook_follow_url' );
                $model->facebook['profile'] = Request::input( 'facebook_profile' );
                $model->facebook['page'] = Request::input( 'facebook_page' );

                // Check if modification where made to re-authenticate
                if ( $model->facebook['enabled']
                    && ($check['enabled'] != $model->facebook['enabled']
                        || $check['app_id'] != $model->facebook['app_id']
                        || $check['app_secret'] != $model->facebook['app_secret']
                        || $check['api_version'] != $model->facebook['api_version']
                    )
                ) {
                    $redirect_url =
                        admin_url( 'options-general.php?page=social-feeder-settings&trigger=social-feeder&action=auth-facebook' );
                }

                if ( !$model->is_twitter_setup )
                    $model->twitter = [];

                $model->twitter['enabled'] = Request::input( 'twitter_enabled', 0 );
                $model->twitter['api_key'] = Request::input( 'twitter_api_key' );
                $model->twitter['api_secret'] = Request::input( 'twitter_api_secret' );
                $model->twitter['token'] = Request::input( 'twitter_token' );
                $model->twitter['token_secret'] = Request::input( 'twitter_token_secret' );
                $model->twitter['screen_name'] = Request::input( 'twitter_screen_name' );
                $model->twitter['follow_url'] = Request::input( 'twitter_follow_url' );

                if ( !$model->is_instagram_setup )
                    $model->instagram = [];

                $check = $model->instagram;

                $model->instagram['enabled'] = Request::input( 'instagram_enabled', 0 );
                $model->instagram['client_id'] = Request::input( 'instagram_client_id' );
                $model->instagram['client_secret'] = Request::input( 'instagram_client_secret' );
                $model->instagram['redirect_url'] = admin_url( 'index.php?trigger=instagram-callback' );
                $model->instagram['follow_url'] = Request::input( 'instagram_follow_url' );

                // Check if modification where made to re-authenticate
                if ( $model->instagram['enabled']
                    && ($check['enabled'] != $model->instagram['enabled']
                        || $check['client_id'] != $model->instagram['client_id']
                        || $check['client_secret'] != $model->instagram['client_secret']
                    )
                ) {
                    $redirect_url =
                        admin_url( 'options-general.php?page=social-feeder-settings&trigger=social-feeder&action=auth-instagram' );
                }

                // SNAPCHAT
                if ( !$model->is_snapchat_setup )
                    $model->snapchat = [];

                $model->snapchat['enabled'] = Request::input( 'snapchat_enabled', 0 );
                $model->snapchat['username'] = Request::input( 'snapchat_username' );
                $model->set_snapchat_password( Request::input( 'snapchat_password' ) );

                $model->save();

                // Clear cache
                Cache::forget( 'socialfeeder' );
                Cache::forget( 'socialfeeder_feeds' );

                // Check if redirection is needed
                if ( ! empty( $redirect_url ) ) {
                    $this->view->show( 'plugins.social-feeder.admin.trigger', [
                        'location' => $redirect_url
                    ] );
                    die;
                }

                return __( 'Settings saved.', 'SocialFeeder' );

            } catch (Exception $e) {
                Log::error($e);
            }
        }
        return;
    }

    /**
     * Enqueues / registers styles.
     * @since 1.0.0
     */
    public function enqueue()
    {
        wp_register_style(
            'font-awesome',
            asset_url( '../css/font-awesome.min.css' , __FILE__ ),
            [],
            '4.5.0'
        );
        wp_register_style(
            'social-feeder',
            asset_url( '../css/social-feeder.css' , __FILE__ ),
            [ 'font-awesome' ],
            '1.0.0'
        );
    }
}
