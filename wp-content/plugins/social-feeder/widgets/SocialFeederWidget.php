<?php

use Amostajo\WPPluginCore\Cache;
use SocialFeeder\Models\SocialFeeder;

/**
 * Social Feeder Widget.
 *
 * @author Alejandro Mostajo <http://about.me/amostajo>
 * @copyright 10Quality <http://www.10quality.com>
 * @license copyright
 * @package SocialFeeder
 * @version 1.0.0
 */
class SocialFeederWidget extends WP_Widget
{
    /**
     * Plugin's MAIN reference
     * @since 1.0.0
     * @var object
     */
    protected $plugin;

    /**
     * Constructor.
     * @since 1.0.0
     */
    public function __construct( $id = '', $name = '', $args = array() )
    {
        global $socialfeeder;
        $this->plugin = $socialfeeder;
        parent::__construct(
            'social-feeder-widget',
            'Social Feeder',
            [
                'classname'     => 'SocialFeederWidget',
                'description'   => 'Displays Social Media feed.',
            ]
        );
    }

    /**
     * Widget display functionality.
     * @since 1.0.0
     *
     * @param array $args     Arguments for the theme.
     * @param class $instance Parameters.
     */
    public function widget( $args, $instance )
    {
        $socialFeeder = Cache::remember(
            'socialfeeder',
            43200,
            function () {
                return SocialFeeder::find();
            }
        );
        if ( $socialFeeder->enqueue_styles )
            wp_enqueue_style( 'social-feeder' );
        echo $args['before_widget'];
        $this->plugin->view( 'plugins.social-feeder.feed', [
            'feeds'         => Cache::remember(
                                'socialfeeder_feeds',
                                $socialFeeder->frequency,
                                function() use($socialFeeder, $instance) {
                                    return $socialFeeder
                                        ->instance( $instance )
                                        ->feeds;
                                }
                            ),
            'socialFeeder'  => $socialFeeder,
        ] );
        echo $args['after_widget'];
    }

    /**
     * Widget update functionality.
     * @since 1.0.0
     *
     * @param array $new_instance Widget instance.
     * @param array $old_instance Widget instance.
     *
     * @return array
     */ 
    public function update( $new_instance, $old_instance )
    {
        $instance = $old_instance;

        $instance['count'] = intval( $new_instance['count'] );

        return $instance;
    }

    /**
     * Widget update functionality.
     * @since 1.0.0
     *
     * @param array $new_instance Widget instance.
     * @param array $old_instance Widget instance.
     *
     * @return array
     */
    public function form( $instance )
    {
        $socialFeeder = Cache::remember(
            'socialfeeder',
            43200,
            function () {
                return SocialFeeder::find();
            }
        );
        // Get info
        $instance = wp_parse_args( (array)$instance, [
            'count'     => $socialFeeder->limit ? $socialFeeder->limit : 4,
        ] );
        // Display form
        $this->plugin->view( 'plugins.social-feeder.admin.widgets.form', [
            'widget'    => $this,
            'instance'  => $instance,
        ] );
    }
}