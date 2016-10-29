<?php

namespace SocialFeeder\Models;

use SocialFeeder\Traits\AliasTrait;
use Amostajo\LightweightMVC\Contracts\Modelable;
use Amostajo\LightweightMVC\Contracts\Findable;
use Amostajo\LightweightMVC\Contracts\Arrayable;
use Amostajo\LightweightMVC\Contracts\JSONable;
use Amostajo\LightweightMVC\Contracts\Stringable;

/**
 * Abstract Model Class based on Wordpress Model.
 *
 * @author Alejandro Mostajo <http://about.me/amostajo>
 * @copyright 10Quality <http://www.10quality.com>
 * @license copyright
 * @package SocialFeeder
 * @version 1.0.0
 */
abstract class OptionModel implements Modelable, Arrayable, JSONable, Stringable
{
    use AliasTrait;

    /**
     * Option prefix.
     * @var string
     */
    protected $prefix = 'model_';

    /**
     * Model id.
     * @var string
     */
    protected $id;
    
    /**
     * Attributes in model.
     * @var array
     */
    protected $attributes = array();

    /**
     * Attributes and aliases hidden from print.
     * @var array
     */
    protected $hidden = array();

    /**
     * Field aliases.
     * @var array
     */
    protected $aliases = array();

    /**
     * Default constructor.
     */
    public function __construct()
    {
        if ( isset( $this->id ) && ! empty( $this->id )  )
            $this->load($this->id);
    }

    /**
     * Loads model from db.
     *
     * @param string $id Option key ID.
     */
    public function load( $id )
    {
        $this->attributes = json_decode(
            get_option( $this->prefix . $this->id ),
            true
        );
        if ( $this->attributes == null )
            $this->attributes = array();
    }

    /**
     * Saves current model in the db.
     *
     * @return mixed.
     */
    public function save()
    {
        if ( ! $this->is_loaded() ) return false;

        $this->fill_defaults();

        update_option(
            $this->prefix . $this->id,
            json_encode( $this->attributes )
        );

        return true;
    }

    /**
     * Deletes current model in the db.
     *
     * @return mixed.
     */
    public function delete()
    {
        if ( ! $this->is_loaded() ) return false;

        delete_option( $this->prefix . $this->id);

        return true;
    }

    /**
     * Returns flag indicating if object is loaded or not.
     *
     * @return bool
     */
    public function is_loaded()
    {
        return !empty( $this->attributes );
    }

    /**
     * Fills default when about to create object
     */
    private function fill_defaults()
    {
        if ( ! array_key_exists('ID', $this->attributes) ) {

            $this->attributes['ID'] = $this->id;

        }
    }
}
