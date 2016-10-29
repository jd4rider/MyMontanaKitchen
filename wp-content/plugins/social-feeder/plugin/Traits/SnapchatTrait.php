<?php

namespace SocialFeeder\Traits;

use TwitterAPIExchange;
use SocialFeeder\Models\Feed;
use Amostajo\WPPluginCore\Log;

/**
 * Snapchat trait.
 * Uses Snapchat's API and PHP client to get feed.
 *
 * @author Alejandro Mostajo <http://about.me/amostajo>
 * @copyright 10Quality <http://www.10quality.com>
 * @license copyright
 * @package SocialFeeder
 * @version 1.0.0
 */
trait SnapchatTrait
{
    /**
     * Adds feeds from snapchat to current feed list.
     * @since 1.0.0
     *
     * @param array $feeds Current feeds (by reference).
     */
    protected function feed_from_snapchat( &$feeds )
    {
        if ( $this->is_snapchat_ready) {
            try {   
                // TODO
            } catch ( Exception $e ) {
                Log::error( $e );
            }
        }
    }

    /**
     * Returns flag indicating if snapchat settings are in place.
     * @since 1.0.0
     *
     * @return bool
     */
    protected function is_snapchat_setup()
    {
        return $this->snapchat && is_array( $this->snapchat );
    }

    /**
     * Returns flag indicating if instagram is ready for usage.
     * @since 1.0.0
     *
     * @return bool
     */
    protected function is_snapchat_ready()
    {
        return $this->is_snapchat_setup
            && array_key_exists( 'enabled', $this->snapchat )
            && $this->snapchat['enabled']
            && array_key_exists( 'connected', $this->snapchat )
            && $this->snapchat['connected'];
    }

    /**
     * Sets and encrypts snapchat password.
     * @since 1.0.0
     *
     * @param string $password Password.
     */
    public function set_snapchat_password( $password )
    {
        if ( ! $this->is_snapchat_setup )
            return;
        $this->snapchat['password'] = $this->encrypt( $password );
        return $this;
    }

    /**
     * Returns dencrypted snapchat password.
     * @since 1.0.0
     *
     * @return string Password.
     */
    protected function get_snapchat_password()
    {
        if ( ! $this->is_snapchat_setup )
            return;
        return $this->decrypt( $this->snapchat['password'] );
    }
}