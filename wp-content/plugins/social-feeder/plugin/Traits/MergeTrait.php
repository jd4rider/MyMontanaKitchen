<?php

namespace SocialFeeder\Traits;

use Amostajo\WPPluginCore\Log;

/**
 * Merge Trait.
 * Adds merge methods.
 *
 * @author Alejandro Mostajo <http://about.me/amostajo>
 * @copyright 10Quality <http://www.10quality.com>
 * @license copyright
 * @package SocialFeeder
 * @version 1.0.0
 */
trait MergeTrait
{
    /**
     * Merges all feeds into one, sorts them by date and limits them based on settings.
     * @since 1.0.0
     *
     * @param array $feeds Current feeds (by reference).
     */
    protected function feed_merge( &$feeds )
    {
        // Create our merge priority
        $times = [];
        for ( $i = count( $feeds ) - 1; $i >= 0; --$i ) {
            $times[] = intval( $feeds[$i]->time );
        }
        // Sort high to low
        arsort( $times );
        // Assign new feed
        $new = [];
        $limit = $this->instance ? $this->instance['count'] : $this->limit;
        foreach ( $times as $time ) {
            // Search in feeds
            for ( $ifeed = count( $feeds ) - 1; $ifeed >= 0; --$ifeed ) {
                if ( $feeds[$ifeed]->time == $time
                    && count( $new ) < $limit
                ) {
                    $new[] = $feeds[$ifeed];
                }
            }
            // Break when limit is reached
            if ( count( $new ) >= $limit )
                break;
        }
        // Assign new arrangement and merge
        $feeds = $new;
    }
}