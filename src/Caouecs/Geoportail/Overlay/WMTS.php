<?php namespace Caouecs\Geoportail\Overlay;

use Caouecs\Geoportail\Map;

class WMTS extends Raster {

    /**
     * Type
     *
     * @access protected
     * @var string
     */
    protected $type = "WMTS";

     /**
     * Create
     *
     * @access public
     * @param string $name Name of layer
     * @param string $path Path of layer
     * @param array $param_layer Params of layer
     * @param array $param_popup Params of popup
     * @return WMTS
     */
    public static function create($name, $path, $param_layer = array(), $param_popup = array())
    {
        return new WMTS($name, $path, $param_layer, $param_popup);
    }
}