<?php namespace Caouecs\Geoportail\Overlay;

use Caouecs\Geoportail\Helpers;

class Vector extends Core {

    /**
     * Name
     *
     * @access protected
     * @var string
     */
    protected $name = null;

    /**
     * Path
     *
     * @access protected
     * @var string
     */
    protected $path = null;

    /**
     * Param layer
     *
     * @access protected
     * @var array
     */
    protected $param_layer = array();

    /**
     * Param popup
     *
     * @access protected
     * @var array
     */
    protected $param_popup = array();

    /**
     * Construct
     *
     * @access public
     * @param string $name Name of layer
     * @param string $path Path of layer
     * @param array $param_layer Params of layer
     * @param array $param_popup Params of popup
     * @return void
     */
    public function __construct($name, $path, $param_layer = array(), $param_popup = array())
    {
        $this->name = e($name);
        $this->path = (string) $path;

        // verif param_layer
        $this->param_layer = self::verifParamLayer($param_layer);

        // verif param_popup
        $this->param_popup = self::verifParamPopup($param_popup);
    }

    /**
     * Set path
     *
     * @access public
     * @param string $path
     * @return \Vector
     */
    public function setPath($path)
    {
        $this->path = (string) $path;

        return $this;
    }

    /**
     * Set params layer
     *
     * @access public
     * @param string $param
     * @param string $value
     * @return \Vector
     */
    public function setParamLayer($param, $value)
    {
        $this->param_layer[$param] = $value;

        return $this;
    }

    /**
     * Remove params layer
     *
     * @access public
     * @param string $param
     * @return \Vector
     */
    public function removeParamLayer($param)
    {
        if (isset($this->param_layer[$param])) {
            unset($this->param_layer[$param]);
        }

        return $this;
    }

    /**
     * Verif datas of param_layer
     *
     * @access protected
     * @param array $param_layer Params of layer
     * @return array
     *
     * @todo Add styleMap and others options
     */
    protected static function verifParamLayer($param_layer)
    {
        if (!is_array($param_layer)) {
            return null;
        }

        $validator = array(
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
            )
        );

        return Helpers::validArray($param_layer, $validator);
    }

    /**
     * Set params popup
     *
     * @access public
     * @param string $param
     * @param string $value
     * @return \Vector
     */
    public function setParamPopup($param, $value)
    {
        $this->param_popup[$param] = $value;

        return $this;
    }

    /**
     * Remove params popup
     *
     * @access public
     * @param string $param
     * @return \Vector
     */
    public function removeParamPopup($param)
    {
        if (isset($this->param_popup[$param])) {
            unset($this->param_popup[$param]);
        }

        return $this;
    }

    /**
     * Verif datas of param_popup
     *
     * @access protected
     * @param array $param_popup Params of popup
     * @return array
     *
     * @todo Finish it
     */
    protected static function verifParamPopup($param_popup)
    {
        if (!is_array($param_popup)) {
            return null;
        }

        // for the moment, return null
        return null;
    }
}