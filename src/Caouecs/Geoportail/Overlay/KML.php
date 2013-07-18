<?php namespace Caouecs\Geoportail\Overlay;

use Caouecs\Geoportail\Map;

class KML extends Vector {

    /**
     * Type
     *
     * @access protected
     * @var string
     */
    protected $type = "KML";

     /**
     * Create
     *
     * @access public
     * @param string $name Name of layer
     * @param string $path Path of layer
     * @param array $param_layer Params of layer
     * @param array $param_popup Params of popup
     * @return KML
     */
    public static function create($name, $path, $param_layer = array(), $param_popup = array())
    {
        return new KML($name, $path, $param_layer, $param_popup);
    }

    /**
     * Get rules for param layer for KML
     *
     * @access public
     * @return array
     */
    public function rules_layer()
    {
        return array(
            "projection",
            "preFeatureInsert",
            "onFeatureInsert",
            "formatOptions" => array("array", null,
                array(
                    "internalProjection",
                    "extractAttributes" => array("boolean", true),
                    "extractStyles" => array("boolean", true)
                )
            )
        );
    }
}