<?php namespace Caouecs\Geoportail\Overlay;

use Caouecs\Geoportail\Map;

class WFS extends Vector {

    /**
     * Type
     *
     * @access protected
     * @var string
     */
    protected $type = "WFS";

     /**
     * Create
     *
     * @access public
     * @param string $name Name of layer
     * @param string $path Path of layer
     * @param array $param_layer Params of layer
     * @param array $param_popup Params of popup
     * @return \WFS
     */
    public static function create($name, $path, $param_layer = array(), $param_popup = array())
    {
        return new WFS($name, $path, $param_layer, $param_popup);
    }

    /**
     * Verif params layer
     *
     * @access protected
     * @param array $param_layer
     * @return array
     */
    protected static function verifParamLayer($param_layer)
    {
        return parent::verifParamLayer($param_layer);
    }

    /**
     * Verif params popup
     *
     * @access protected
     * @param array $param_popup
     * @return array
     */
    protected static function verifParamPopup($param_popup)
    {
        return parent::verifParamPopup($param_popup);
    }
}