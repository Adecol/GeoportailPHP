<?php namespace Caouecs\Geoportail\Layer;

use Caouecs\Geoportail\Map;

class Option {
    /**
     * List of layer options
     *
     * @access public
     * @var array
     */
    public $list = array();

    /**
     * Construct
     *
     * @access public
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Create
     *
     * @access public
     * @return Option
     */
    public static function create()
    {
        return new Option;
    }

    /**
     * Remove option
     *
     * @access public
     * @param string $layer_name Name of layer
     * @return Option
     */
    public function remove($layer_name)
    {
        // verif if exists in list
        if (!isset($this->list[$layer_name])) {
            unset($this->list[$layer_name]);
        }

        return $this;
    }

    /**
     * Add/Update option
     *
     * @access public
     * @param string $layer_name Name of layer
     * @param string $options List of options
     * @return Option
     */
    public function set($layer_name, $options)
    {
        $this->list[$layer_name] = $options;

        return $this;
    }

    /**
     * Add to map
     *
     * @access public
     * @param Map $map Map
     * @return void
     */
    public function addTo(Map &$map)
    {
        if (!empty($this->list)) {
            $map->layer_option = $this->list;
        }
    }
}