<?php namespace Caouecs\Geoportail;

use \HTML, \Config, \View;

class Map {

    /**
     * Type of Geoportail API
     *
     * @access protected
     * @var array
     *
     * @todo mobile, 3D
     */
    protected static $geoportail_api = array("default", "min", "extended");

    /**
     * Canvas id
     *
     * @access protected
     * @var string
     */
    protected $id = "canvas_map";

    /**
     * Type of map js
     *
     * @access protected
     * @var string
     */
    protected $api = "default";

    /**
     * Center of map
     *
     * @access protected
     * @var string | array
     */
    protected $center = null;

    /**
     * Key of Geoportail
     *
     * @access protected
     * @var string
     */
    protected $key = null;

    /**
     * Zoom of map
     *
     * @access protected
     * @var int
     */
    protected $zoom = 7;

    /**
     * Options of map
     *
     * @access public
     * @var array
     */
    public $options = array();

    /**
     * Layer Options
     *
     * @access public
     * @var array
     */
    public $layer_option = array();

    /**
     * Overlays of map
     *
     * @access public
     * @var array
     */
    public $overlays = array();

    /**
     * Functions on map
     *
     * @access public
     * @var string
     */
    public $functions = null;

    /**
     * Create a Geoportail map
     *
     * @access public
     * @param string $id Canvas id
     * @param string $api Type of api
     * @return void
     */
    public function __construct($id = null, $api = null)
    {
        // canvas id
        if ($id != null) {
            $this->id = e($id);
        }

        // API
        if ($api != null) {
            $this->setAPI($api);
        }

        // key
        $this->key = Config::get("geoportail::geoportail.key");

        // center
        $this->setCenter(
            Config::get("geoportail::geoportail.center.type"),
            Config::get("geoportail::geoportail.center.value")
        );

        // by default
        $this->options = array(
            "type" => "js",
            "language" => Config::get("geoportail::geoportail.language")
        );
    }

    /**
     * Create with Default viewer
     *
     * @access public
     * @param string $id Canvas id
     * @param string $api Type of api
     * @return \Map
     */
    public static function create($id = null, $api = null)
    {
        $map = new Map($id, $api);

        $map->setViewerClass("Default");

        return $map;
    }

    /**
     * Create with Simple viewer
     *
     * @access public
     * @param string $id Canvas id
     * @param string $api Type of api
     * @return \Map
     */
    public static function createSimple($id = null, $api = null)
    {
        $map = new Map($id, $api);

        $map->setViewerClass("Simple");

        return $map;
    }

    /**
     * Create with Standard viewer
     *
     * @access public
     * @param string $id Canvas id
     * @param string $api Type of api
     * @return \Map
     */
    public static function createStandard($id = null, $api = null)
    {
        $map = new Map($id, $api);

        $map->setViewerClass("Standard");

        return $map;
    }

    /**
     * Get ID
     *
     * @access public
     * @return string
     */
    public function getID()
    {
        return $this->id;
    }

    /**
     * API
     *
     * @access public
     * @param string $api New api
     * @return \Map
     */
    public function setAPI($api)
    {
        $api = strtolower($api);
        if (in_array($api, self::$geoportail_api)) {
            $this->api = $api;
        }

        return $this;
    }

    /**
     * Key
     *
     * @access public
     * @param string $key New key
     * @return \Map
     */
    public function setKey($key)
    {
        if (is_string($key)) {
            $this->key = e($key);
        }

        return $this;
    }

    /**
     * Zoom
     *
     * @access public
     * @param int $zoom New zoom
     * @return \Map
     */
    public function setZoom($zoom)
    {
        if (is_int($zoom) && $zoom <= 21) {
            $this->zoom = $zoom;
        }

        return $this;
    }

    /**
     * ViewerClass
     *
     * @access public
     * @param string $viewerClass New viewerClass
     * @return \Map
     */
    public function setViewerClass($viewerClass)
    {
        // viewerClass
        if ($viewerClass === "Default" || $viewerClass === "Standard" || $viewerClass === "Simple") {
            $this->options['viewerClass'] = 'Geoportal.Viewer.'.$viewerClass;
        }

        return $this;
    }

    /**
     * Center
     *
     * @access public
     * @param string $type Type of center
     * @param string|array $value Value of center
     * @return \Map
     */
    public function setCenter($type, $value)
    {
        // Address and Place
        if (($type === "address" || $type === "place") && is_string($value)) {
            $this->center = $type.': "'.e($value).'"';
        // OpenLayers
        } elseif ($type == "OpenLayers" && is_string($value)) {
            $this->center = 'center: new OpenLayers.LonLat('.e($value).')';
        // Geolocate
        } elseif ($type == "geolocate" && $value === true) {
            $this->center = 'geolocate: true';
            $this->options['marker'] = false;
        // GPS
        } elseif ($type === "gps" && is_array($value) && count($value) == 2) {
            $this->center = 'lon: "'.e($value[0]).'", lat: "'.e($value[1]).'"';
        }

        return $this;
    }

    /**
     * Language
     *
     * @access public
     * @param string $language New language
     * @return \Map
     */
    public function setLanguage($language)
    {
        if (is_string($language) && mb_strlen($language) == 2) {
            $this->options['language'] = $language;
        }

        return $this;
    }

    /**
     * displayProjection
     *
     * @access public
     * @param string $displayProjection New displayProjection
     * @return \Map
     */
    public function setDisplayProject($displayProjection)
    {
        if (is_string($displayProjection)) {
            $this->options['displayProjection'] = e($displayProjection);
        }

        return $this;
    }

    /**
     * proxyUrl
     *
     * @access public
     * @param string $proxyUrl New proxyUrl
     * @return \Map
     */
    public function setProxyUrl($proxyUrl)
    {
        if (is_string($proxyUrl)) {
            $this->options['proxyUrl'] = e($proxyUrl);
        }

        return $this;
    }

    /**
     * Hidden marker
     *
     * @access public
     * @return \Map
     */
    public function hiddenMarker()
    {
        $this->options['overlays'] = array();

        return $this;
    }

    /**
     * Visible marker
     *
     * @access public
     * @return \Map
     */
    public function visibleMarker()
    {
        if (isset($this->options['overlays'])) {
            unset($this->options['overlays']);
        }

        return $this;
    }

    /**
     * Remove overlays
     *
     * @access public
     * @param string $overlays Name of overlays
     * @return \Map
     */
    public function removeOverlays($overlays)
    {
        if (isset($this->overlays[$overlays])) {
            unset($this->overlays[$overlays]);
        }

        return $this;
    }

   /**
     * Display canvas map
     *
     * @access public
     * @param string $width
     * @param string $height
     * @param array $attributes Attributes of canvas
     * @return string
     */
    public function canvas($width = null, $height = null, $attributes = array())
    {
        // attributes
        $attributes = Helpers::add_class($attributes, $this->id, "id");

        // size
        if ($width == null) {
            $width = Config::get("geoportail::geoportail.canvas.width");
        }
        if ($height == null) {
            $height = Config::get("geoportail::geoportail.canvas.height");
        }

        $attributes = Helpers::add_class($attributes, "width: ".e($width)."; height: ".e($height), "style");

        return '<div'.HTML::attributes($attributes).'></div>';
    }

    /**
     * Script js
     *
     * @access public
     * @return string
     */
    public function asset()
    {
        if ($this->api == "default") {
            $this->api = null;
        }

        return '<script src="'.Config::get("geoportail::geoportail.asset.js").'/Geoportal'.$this->api.'.js"></script>';
    }

    /**
     * Display map javascript
     *
     * @access public
     * @return string
     */
    public function __toString()
    {
        $options = null;

        if (!empty($this->options)) {
            $tmp = null;
            foreach ($this->options as $key => $value) {
                if (is_array($value)) {
                    $tmp[] = $key.":".json_encode($value);
                } else {
                    $tmp[] = $key.":'".$value."'";    
                }
            }
            $options = implode(", ", $tmp);
        }

        if (!empty($this->overlays) || !empty($this->functions)) {
            //$options .= ', onView: initMap';
        }

        // layer options
        if (!empty($this->layer_option)) {
            $options .= ', layersOptions: {';

            $_opt = null;
            foreach ($this->layer_option as $key => $value) {
                $_opt[] = "'".$key."': {".$value."}";
            }


            $options .= implode(",", $_opt).'}';
        }

        // overlays
        /*if (!empty($this->overlays)) {
            $options .= ', overlays: '.json_encode($this->overlays);
        }*/

        // base
        $view = array(
            "id" => $this->id,
            "key" => $this->key,
            "zoom" => $this->zoom,
            "center" => $this->center,
            "options" => $options,
            "overlays" => $this->overlays,
            "functions" => null
        );

        return View::make("geoportail::loader", $view)->render();
    }
}