<?php

namespace SocialFeeder\Controllers;

use Exception;
use Instagram\Core\ApiException;
use Instagram\Auth;
use SocialFeeder\Models\SocialFeeder;
use Amostajo\LightweightMVC\Controller;
use Amostajo\LightweightMVC\Request;
use Amostajo\WPPluginCore\Log;
use Amostajo\WPPluginCore\Cache;
use Facebook\Exceptions\FacebookAuthenticationException;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;
use Facebook\Facebook;

/**
 * Handles authentication and callbacks functionality.
 *
 * @author Alejandro Mostajo <http://about.me/amostajo>
 * @copyright 10Quality <http://www.10quality.com>
 * @license copyright
 * @package TenQuality\SocialFeeder
 * @version 1.0.2
 */
class AuthController extends Controller
{
    /**
     * Starts authentication.
     * Checks on triggers process authenticaton.
     * @since 1.0.0
     * @since 1.0.2 Added session check.
     */
    public function start()
    {
        if (session_status() === PHP_SESSION_NONE)
            session_start();
        if ( Request::input( 'trigger' ) === 'social-feeder' ) {
            switch ( Request::input( 'action' ) ) {
                case 'auth-instagram':
                    $this->auth_instagram();
                    break;
                case 'auth-facebook':
                    $this->auth_facebook();
                    break;
            }
        }
        switch ( Request::input( 'trigger' ) ) {
            case 'instagram-callback':
                $this->callback_instagram();
                break;
            case 'facebook-callback':
                $this->callback_facebook();
                break;
        }
    }

    /**
     * Authenticates instagram application.
     * @since 1.0.0
     */
    public function auth_instagram()
    {
        try {
            $socialFeeder = get_social_feeder();
            if ( $socialFeeder->is_instagram_setup
                && isset( $socialFeeder->instagram['enabled'] )
                && $socialFeeder->instagram['enabled']
                && isset( $socialFeeder->instagram['client_id'] )
                && isset( $socialFeeder->instagram['client_secret'] )
            ) {
                $auth = new Auth( [
                    'client_id'         => $socialFeeder->instagram['client_id'],
                    'client_secret'     => $socialFeeder->instagram['client_secret'],
                    'redirect_uri'      => $socialFeeder->instagram['redirect_url'],
                    'scope'             => [ 'basic', 'relationships', 'public_content' ]
                ] );
                $auth->authorize();
                exit;
            }
        } catch ( ApiException $e ) {
            Log::error( $e );
        }
    }

    /**
     * Performs Instragram's callback and sets access token.
     * @since 1.0.0
     */
    public function callback_instagram()
    {
        $socialFeeder = get_social_feeder();
        try {
            if ( $socialFeeder->is_instagram_setup
                && isset( $socialFeeder->instagram['enabled'] )
                && $socialFeeder->instagram['enabled']
                && isset( $socialFeeder->instagram['client_id'] )
                && isset( $socialFeeder->instagram['client_secret'] )
            ) {
                $auth = new Auth( [
                    'client_id'         => $socialFeeder->instagram['client_id'],
                    'client_secret'     => $socialFeeder->instagram['client_secret'],
                    'redirect_uri'      => $socialFeeder->instagram['redirect_url'],
                    'scope'             => [ 'basic', 'relationships', 'public_content' ]
                ] );
                $code = Request::input( 'code' );
                if ( $code ) {
                    $socialFeeder->instagram['access_token'] = $auth->getAccessToken( $code );
                    $socialFeeder->save();
                    Cache::forget( 'socialfeeder' );
                    Cache::forget( 'socialfeeder_feeds' );
                    wp_redirect( admin_url(
                        'options-general.php?page=social-feeder-settings&tab=instagram&notice=' . urlencode(
                            __( 'Settings saved and Instagram authenticated.', 'SocialFeeder' )
                        )
                    ) );
                    exit;
                }
            }
        } catch ( ApiException $e ) {
            Log::error( $e );
        }

        try {
            $socialFeeder->instagram['access_token'] = null;
            $socialFeeder->save();
            Cache::forget( 'socialfeeder' );
        } catch ( Exception $e ) {
            Log::error( $e );
        }

        wp_redirect( admin_url(
            'options-general.php?page=social-feeder-settings&tab=instagram&error=' . urlencode(
                __( 'Settings saved, but could not authenticate with Instragram. Review your configuration and try again.', 'SocialFeeder' )
            )
        ) );
        exit;
    }

    /**
     * Authenticates facebook application.
     * @since 1.0.1
     */
    public function auth_facebook()
    {
        try {
            $socialFeeder = get_social_feeder();
            if ( $socialFeeder->is_facebook_setup
                && isset( $socialFeeder->facebook['enabled'] )
                && $socialFeeder->facebook['enabled']
                && isset( $socialFeeder->facebook['app_id'] )
                && isset( $socialFeeder->facebook['app_secret'] )
                && isset( $socialFeeder->facebook['api_version'] )
            ) {
                $fb = new Facebook( [
                    'app_id'                => $socialFeeder->facebook['app_id'],
                    'app_secret'            => $socialFeeder->facebook['app_secret'],
                    'default_graph_version' => $socialFeeder->facebook['api_version'],
                ] );
                $helper = $fb->getRedirectLoginHelper();
                wp_redirect( $helper->getLoginUrl( $socialFeeder->facebook[ 'redirect_url' ], [
                    'email', 'public_profile', 'user_posts', 'manage_pages',
                ] ) );
                exit;
            }
        } catch ( FacebookAuthenticationException $e ) {
            Log::error( $e );
        }
    }

    /**
     * Performs Facebook's callback and sets access token.
     * @since 1.0.1
     */
    public function callback_facebook()
    {
        $socialFeeder = get_social_feeder();
        try {
            if ( $socialFeeder->is_facebook_setup
                && isset( $socialFeeder->facebook['enabled'] )
                && $socialFeeder->facebook['enabled']
                && isset( $socialFeeder->facebook['app_id'] )
                && isset( $socialFeeder->facebook['app_secret'] )
                && isset( $socialFeeder->facebook['api_version'] )
            ) {
                $fb = new Facebook( [
                    'app_id'                => $socialFeeder->facebook['app_id'],
                    'app_secret'            => $socialFeeder->facebook['app_secret'],
                    'default_graph_version' => $socialFeeder->facebook['api_version'],
                ] );
                $token = $fb->getRedirectLoginHelper()->getAccessToken();
                $token = $fb->getOAuth2Client()->getLongLivedAccessToken( $token );
                if ( $token ) {
                    $socialFeeder->facebook['access_token'] = (string)$token;
                    $socialFeeder->save();
                    Cache::forget( 'socialfeeder' );
                    Cache::forget( 'socialfeeder_feeds' );
                    wp_redirect( admin_url(
                        'options-general.php?page=social-feeder-settings&tab=facebook&notice=' . urlencode(
                            __( 'Settings saved and Facebook authenticated.', 'SocialFeeder' )
                        )
                    ) );
                    exit;
                }
                die;
            }
        } catch ( FacebookResponseException $e ) {
            Log::error( $e );
        } catch ( FacebookAuthenticationException $e ) {
            Log::error( $e );
        } catch ( FacebookSDKException $e ) {
            Log::error( $e );
        }

        try {
            $socialFeeder->facebook['access_token'] = null;
            $socialFeeder->save();
            Cache::forget( 'socialfeeder' );
            Cache::forget( 'facebook_accounts' );
        } catch ( Exception $e ) {
            Log::error( $e );
        }

        wp_redirect( admin_url(
            'options-general.php?page=social-feeder-settings&tab=facebook&error=' . urlencode(
                __( 'Settings saved, but could not authenticate with Facebook. Review your configuration and try again.', 'SocialFeeder' )
            )
        ) );
        exit;
    }
}
