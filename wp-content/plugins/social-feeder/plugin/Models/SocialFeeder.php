<?php

namespace SocialFeeder\Models;

use SocialFeeder\Models\OptionModel;
use SocialFeeder\Traits\TwitterTrait;
use SocialFeeder\Traits\InstagramTrait;
use SocialFeeder\Traits\MergeTrait;
use SocialFeeder\Traits\FacebookTrait;
use SocialFeeder\Traits\SnapchatTrait;

/**
 * Social Feeder option based model.
 *
 * @author Alejandro Mostajo <http://about.me/amostajo>
 * @copyright 10Quality <http://www.10quality.com>
 * @license copyright
 * @package SocialFeeder
 * @version 1.0.3
 */
class SocialFeeder extends OptionModel
{
    use TwitterTrait, InstagramTrait, MergeTrait, FacebookTrait, SnapchatTrait;

    /**
     * Model id.
     * @since 1.0.0
     * @var string
     */
    protected $id = 'socialFeeder';

    /**
     * Widget instance information.
     * @since 1.0.0
     * @var string
     */
    protected $instance;

    /**
     * Field aliases and definitions.
     * @since 1.0.0
     * @since 1.0.1 Added facebook.
     * @since 1.0.2 Added facebook accounts and pages functions.
     * @since 1.0.3 Added snapchat and e_key.
     *
     * @var array
     */
    protected $aliases = [
        'follow_us'             => 'field_follow_us',
        'merge'                 => 'field_merge',
        'limit'                 => 'field_limit',
        'date_format'           => 'field_date_format',
        'frequency'             => 'field_frequency',
        'enqueue_styles'        => 'field_enqueue_styles',
        'security_key'          => 'field_e_key',
        'feeds'                 => 'func_get_feeds',
        'twitter'               => 'field_twitter',
        'is_twitter_setup'      => 'func_is_twitter_setup',
        'is_twitter_legible'    => 'func_is_twitter_legible',
        'instagram'             => 'field_instagam',
        'is_instagram_setup'    => 'func_is_instagram_setup',
        'is_instagram_ready'    => 'func_is_instagram_ready',
        'is_instagram_legible'  => 'func_is_instagram_legible',
        'facebook'              => 'field_facebook',
        'is_facebook_setup'     => 'func_is_facebook_setup',
        'is_facebook_ready'     => 'func_is_facebook_ready',
        'is_facebook_legible'   => 'func_is_facebook_legible',
        'facebook_accounts'     => 'func_get_facebook_accounts',
        'has_facebook_pages'    => 'func_has_facebook_pages',
        'is_facebook_me'        => 'func_is_facebook_me',
        'facebook_page'         => 'func_get_facebook_page',
        'facebook_id'           => 'func_get_facebook_id',
        'snapchat'              => 'field_snapchat',
        'is_snapchat_setup'     => 'func_is_snapchat_setup',
        'is_snapchat_ready'     => 'func_is_snapchat_ready',
        'snapchat_password'     => 'func_get_snapchat_password',
    ];

    /**
     * Finds and returns record from db.
     * @since 1.0.0
     *
     * @return object
     */
    public static function find()
    {
        return new self();
    }

    /**
     * Sets widget instance.
     * @since 1.0.0
     *
     * @param array $instance Widget instance.
     *
     * @return this for chaining
     */
    public function instance( $instance )
    {
        $this->instance = $instance;
        return $this;
    }

    /**
     * Returns encrypted value.
     * @since 1.0.3
     *
     * @param mixed $value Value to encrypt.
     *
     * @return string
     */
    protected function encrypt( $value )
    {
        return base64_encode( mcrypt_encrypt(
            MCRYPT_RC2,
            $this->security_key,
            $value,
            MCRYPT_MODE_ECB
        ) );
    }

    /**
     * Returns decrypted value.
     * @since 1.0.3
     *
     * @param string $value Value to decrypt.
     *
     * @return mixed
     */
    protected function decrypt( $value ) {
        return trim( mcrypt_decrypt(
            MCRYPT_RC2,
            $this->security_key,
            base64_decode( $value ),
            MCRYPT_MODE_ECB
        ) );
    }

    /**
     * Returns feeds.
     * @since 1.0.0
     *
     * @return array
     */
    protected function get_feeds()
    {
        $feeds = [];
        $this->feed_from_facebook( $feeds );
        $this->feed_from_twitter( $feeds );
        $this->feed_from_instagram( $feeds );
        if ( $this->merge ) {
            $this->feed_merge( $feeds );
        }
        return $feeds;
    }
}