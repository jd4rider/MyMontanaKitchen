<?php

namespace SocialFeeder\Models;

use SocialFeeder\Traits\AliasTrait;

/**
 * Feed custom model.
 *
 * @author Alejandro Mostajo <http://about.me/amostajo>
 * @copyright 10Quality <http://www.10quality.com>
 * @license copyright
 * @package SocialFeeder
 * @version 1.0.1
 */
class Feed
{
    use AliasTrait;

    /**
     * Twitter key.
     * @since 1.0.0
     * @var string
     */
    const FEEDER_TWITTER = 'twitter';

    /**
     * Instagram key.
     * @since 1.0.0
     * @var string
     */
    const FEEDER_INSTAGRAM = 'instagram';

    /**
     * Facebook key.
     * @since 1.0.1
     * @var string
     */
    const FEEDER_FACEBOOK = 'facebook';
    
    /**
     * Attributes in model.
     * @since 1.0.0
     * @var array
     */
    protected $attributes = array();

    /**
     * Attributes and aliases hidden from print.
     * @since 1.0.0
     * @var array
     */
    protected $hidden = array();

    /**
     * Feed aliasses to attributes.
     * @since 1.0.0
     * @var array
     */
    protected $aliases = [
        'profile_image_url'     => 'field_feed_profile_image_url',
        'feeder'                => 'field_feeder',
        'url'                   => 'field_feed_url',
        'time'                  => 'field_feed_time',
        'content'               => 'field_feed_content',
        'media_url'             => 'field_feed_media',
        'media_type'            => 'field_feed_media_type',
        'date_format'           => 'field_date_format',
        'date'                  => 'func_get_date',
    ];

    /**
     * Creates feed from twitter feed.
     * @since 1.0.0
     *
     * @param object $data        Twitter data.
     * @param string $date_format Date format.
     *
     * @return this for chaining
     */
    public function from_twitter( &$data, $date_format = 'F m, J' )
    {
        $this->attributes['date_format'] = $date_format;
        $this->attributes['feeder'] = self::FEEDER_TWITTER;
        // Normalize data
        foreach ( $data as $key => $value ) {
            switch ( $key ) {
                case 'text':
                    $this->attributes['feed_content'] = $value;
                    break;
                case 'id_str':
                    $this->attributes['feed_url'] = get_tweet_url( $value );
                    break;
                case 'created_at':
                    $this->attributes['feed_time'] = strtotime( $value );
                    break;
                case 'profile_image_url':
                    $this->attributes['feed_profile_image_url'] = $value;
                    break;
                case 'extended_entities':
                    if ( $value->media && isset( $value->media[0] ) )
                        $this->attributes['feed_media'] = $value->media[0]->media_url;
                        $this->attributes['feed_media_type'] = 'image';
                    break;
                default:
                    $this->attributes[$key] = $value;
                    break;
            }
        }
        return $this;
    }

    /**
     * Creates feed from instagram feed.
     * @since 1.0.0
     *
     * @param object $media        Instagram media data.
     * @param string $date_format Date format.
     *
     * @return this for chaining
     */
    public function from_instagram( &$media, $date_format = 'F m, J' )
    {
        $this->attributes['date_format'] = $date_format;
        $this->attributes['feeder'] = self::FEEDER_INSTAGRAM;
        // Normalize data
        foreach ( $media->getData() as $key => $value ) {
            switch ( $key ) {
                case 'link':
                    $this->attributes['feed_url'] = $value;
                    break;
                case 'created_time':
                    $this->attributes['feed_time'] = $value;
                    break;
                case 'profile_picture':
                    $this->attributes['feed_profile_image_url'] = $value;
                    break;
                case 'images':
                    $this->attributes['feed_media'] = $value->standard_resolution->url;
                    $this->attributes['feed_media_type'] = 'image';
                    break;
                case 'caption':
                    $this->attributes['feed_content'] = $value->text;
                    break;
                default:
                    $this->attributes[$key] = $value;
                    break;
            }
        }
        return $this;
    }

    /**
     * Creates feed from facebook feed.
     * @since 1.0.1
     *
     * @param array  $data        Feed data.
     * @param string $date_format Date format.
     *
     * @return this for chaining
     */
    public function from_facebook( &$data, $date_format = 'F m, J' )
    {
        $this->attributes['date_format'] = $date_format;
        $this->attributes['feeder'] = self::FEEDER_FACEBOOK;
        // Normalize data
        foreach ( $data as $key => $value ) {
            switch ( $key ) {
                case 'message':
                    $this->attributes['feed_content'] = $value;
                    break;
                case 'created_time':
                    $this->attributes['feed_time'] = strtotime( $value );
                    break;
                case 'story':
                    if ( ! isset( $this->attributes['feed_content'] ) ) {
                        $this->attributes['feed_content'] = '';
                    }
                    $this->attributes['feed_content'] .= '<span class="story">' . $value . '</span>';
                    break;
                case 'type':
                    switch ( $value ) {
                        case 'photo':
                            $this->attributes['feed_media'] = $data['picture'];
                            $this->attributes['feed_media_type'] = 'image';
                            break;
                    }
                    break;
                case 'id':
                    $this->attributes['feed_url'] = get_facebook_url( $value );
                    break;
                default:
                    $this->attributes[$key] = $value;
                    break;
            }
        }
        return $this;
    }

    /**
     * Returns formatted date.
     * @since 1.0.0
     *
     * @return string
     */
    protected function get_date()
    {
        return date( $this->date_format, $this->time );
    }
}