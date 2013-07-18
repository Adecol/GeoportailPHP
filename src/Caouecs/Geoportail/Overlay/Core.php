<?php namespace Caouecs\Geoportail\Overlay;

use Caouecs\Geoportail\Map;

class Core {

    /**
     * Rules for param services
     *
     * @access protected
     * @var array
     */
    protected $rules_param_services = array();

    /**
     * Rules for param popup
     *
     * @access protected
     * @var array
     */
    protected $rules_param_popup = array();

        /*

        onSelect: function
        onUnSelect: function
        hover: ?
        preventDefaultBehavior: boolean

        */

    /**
     * Rules for param layers
     *
     * @access protected
     * @var array
     */
    protected $rules_param_layers = array(
        "visibility" => array("boolean", false),
        "opacity" => array("int", 1, array("min" => 0, "max" => 1)),
        "minZoomLevel" => array("int", 0, array("min" => 0, "max" => 21)),
        "maxZoomLevel" => array("int", 21, array("min" => 0, "max" => 21)),
        "format",
        "maxExtent",
        "isBaseLayer" => array("boolean", false),
        "originators" => array("array", null,
            array(
                "logo",
                "pictureUrl",
                "url",
                "attribution"
            )
        ),
        "styleMap",
        "view" => array("array", null,
            array(
                "drop" => array("boolean", true),
                "zoomToExtend" => array("boolean", true)
            )
        ),
        "constraints" => array("array", null,
            array(
                "maxExtent",
                "maxResolution" => array("int", 21),
                "minResolution" => array("int", 0)
            )
        ),
        "eventListeners" => array("data")
    );

    /**
     * Add to map
     *
     * @access public
     * @param Map $map Map
     * @return void
     */
    public function addTo(Map &$map)
    {
        $tmp = ' viewer_'.$map->getID().'.getMap().addLayer("'.$this->type.'",
            "'.$this->name.'",
            "'.$this->path.'"';

        if (!empty($this->param_layer)) {
            $tmp .= ', '.json_encode($this->param_layer);
        }
        if (!empty($this->param_popup)) {
            $tmp .= ', '.json_encode($this->param_popup);
        }
        $tmp .= '); ';

        $map->overlays[$this->name] = $tmp;
    }
}