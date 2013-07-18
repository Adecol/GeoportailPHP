<?php namespace Caouecs\Geoportail\Overlay;

use Caouecs\Geoportail\Map;

class WMS extends Raster {

    /**
     * Type
     *
     * @access protected
     * @var string
     */
    protected $type = "WMS";

     /**
     * Create
     *
     * @access public
     * @param string $name Name of layer
     * @param string $path Path of layer
     * @param array $param_layer Params of layer
     * @param array $param_popup Params of popup
     * @return WMS
     */
    public static function create($name, $path, $param_layer = array(), $param_popup = array())
    {
        return new WMS($name, $path, $param_layer, $param_popup);
    }
}