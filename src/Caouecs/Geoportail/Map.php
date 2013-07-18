<?php namespace Caouecs\Geoportail;

use \HTML, \Config, \View;

class Map {
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
     * @throws Exception
     */
    public function __construct($id = null, $api = null)
    {
        // key
        $this->key = Config::get("geoportail::geoportail.key");

        if ($this->key == null) {
            throw new Exception('Geoportail key needed');
        }

        // canvas id
        if ($id != null) {
            $this->id = Helpers::protectString($id);
        }

        // API
        if ($api != null) {
            $this->setAPI($api);
        }

        // center
        $this->setCenter(
            Config::get("geoportail::geoportail.center.type"),
            Config::get("geoportail::geoportail.center.value")
        );

        // by default
        $this->options = array(
            "type"      => "js",
            "language"  => Config::get("geoportail::geoportail.language")
        );
    }

    /**
     * Create with Default viewer
     *
     * @access public
     * @param string $id Canvas id
     * @param string $api Type of api
     * @return Map
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
     * @return Map
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
     * @return Map
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
     * @return Map
     */
    public function setAPI($api)
    {
        $api = strtolower($api);
        if (in_array($api, Config::get("geoportail::geoportail.api"))) {
            $this->api = $api;
        }

        return $this;
    }

    /**
     * Key
     *
     * @access public
     * @param string $key New key
     * @return Map
     */
    public function setKey($key)
    {
        if (!empty($key) && is_string($key)) {
            $this->key = Helpers::protectString($key);
        }

        return $this;
    }

    /**
     * Zoom
     *
     * @access public
     * @param int $zoom New zoom
     * @return Map
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
     * @return Map
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
     * @return Map
     */
    public function setCenter($type, $value)
    {
        // Address and Place
        if (($type === "address" || $type === "place") && is_string($value)) {
            $this->center = $type.': "'.Helpers::protectString($value).'"';
        // OpenLayers
        } elseif ($type == "OpenLayers" && is_string($value)) {
            $this->center = 'center: new OpenLayers.LonLat('.Helpers::protectString($value).')';
        // Geolocate
        } elseif ($type == "geolocate" && $value === true) {
            $this->center = 'geolocate: true';
            $this->options['marker'] = false;
        // GPS
        } elseif ($type === "gps" && is_array($value) && count($value) == 2) {
            $this->center = 'lon: "'.Helpers::protectString($value[0]).'", lat: "'.Helpers::protectString($value[1]).'"';
        }

        return $this;
    }

    /**
     * Language
     *
     * @access public
     * @param string $language New language
     * @return Map
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
     * @return Map
     */
    public function setDisplayProject($displayProjection)
    {
        if (is_string($displayProjection)) {
            $this->options['displayProjection'] = Helpers::protectString($displayProjection);
        }

        return $this;
    }

    /**
     * proxyUrl
     *
     * @access public
     * @param string $proxyUrl New proxyUrl
     * @return Map
     */
    public function setProxyUrl($proxyUrl)
    {
        if (is_string($proxyUrl)) {
            $this->options['proxyUrl'] = Helpers::protectString($proxyUrl);
        }

        return $this;
    }

    /**
     * Hidden marker
     *
     * @access public
     * @return Map
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
     * @return Map
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
     * @param string $name Name of overlays
     * @return Map
     */
    public function removeOverlays($name)
    {
        if (isset($this->overlays[$name])) {
            unset($this->overlays[$name]);
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
        $attributes = Helpers::addClass($attributes, $this->id, "id");

        // size
        if ($width == null) {
            $width = Config::get("geoportail::geoportail.canvas.width");
        }
        if ($height == null) {
            $height = Config::get("geoportail::geoportail.canvas.height");
        }

        $attributes = Helpers::addClass($attributes, "width: ".Helpers::protectString($width)."; height: ".Helpers::protectString($height), "style");

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


        // layer options
        if (!empty($this->layer_option)) {
            $options .= ', layersOptions: {';

            $_opt = null;
            foreach ($this->layer_option as $key => $value) {
                $_opt[] = "'".$key."': {".$value."}";
            }


            $options .= implode(",", $_opt).'}';
        }

        // base
        $view = array(
            "id"        => $this->id,
            "key"       => $this->key,
            "zoom"      => $this->zoom,
            "center"    => $this->center,
            "options"   => $options,
            "overlays"  => $this->overlays,
            "functions" => null
        );

        return View::make("geoportail::loader", $view)->render();
    }
}