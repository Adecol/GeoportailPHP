<?php namespace Caouecs\Geoportail;

/**
 * Layers of Geoportail map
 *
 */
class Layer {

    /**
     * Lists of layers
     *
     * @access public
     * @var array
     */
    public $list = array();

    /**
     * Layers by default in Geoportail
     *
     * @access public
     * @var array
     */
    public static $geoportail_layers_default = array('ORTHOIMAGERY.ORTHOPHOTOS', 'GEOGRAPHICALGRIDSYSTEMS.MAPS', 'ADMINISTRATIVEUNITS.BOUNDARIES', 'BUILDINGS.BUILDINGS', 'ELEVATION.SLOPES', 'GEOGRAPHICALNAMES.NAMES', 'HYDROGRAPHY.HYDROGRAPHY', 'ELEVATION.LEVEL0', 'TRANSPORTNETWORKS.RAILWAYS', 'TRANSPORTNETWORKS.ROADS', 'TRANSPORTNETWORKS.RUNWAYS', 'UTILITYANDGOVERNMENTALSERVICES.ALL', 'StreetAddress', 'CADASTRALPARCELS.PARCELS', 'PositionOfInterest');

    /**
     * Construct
     *
     * @access public
     * @param array|string $layers Layers
     * @return void
     */
    public function __construct($layers = null)
    {
        if (!empty($layers)) {
            $this->add($layers);
        }
    }

    /**
     * Create
     *
     * @access public
     * @param array|string $layers Layers
     * @return \Layer
     */
    public static function create($layers = null)
    {
        return new Layer($layers);
    }

    /**
     * Add default layers
     *
     * @access public
     * @return \Layer
     */
    public function addDefault()
    {
        $this->add(self::$geoportail_layers_default);

        return $this;
    }

    /**
     * Add one or a list of layers
     *
     * @access public
     * @param array|string $layers Layers
     * @return \Layer
     */
    public function add($layers = null)
    {
        if (!empty($layers)) {
            if (is_array($layers)) {
                foreach ($layers as $layer) {
                    $this->list[] = $layer;
                }
            } else {
                $this->list[] = $layers;
            }
            array_unique($this->list);
        }

        return $this;
    }

    /**
     * Remove one or a list of layers
     *
     * @access public
     * @param array|string $layers Layers
     * @return \Layer
     */
    public function remove($layers = null)
    {
        if (!empty($layers)) {
            if (is_array($layers)) {
                foreach ($layers as $layer) {
                    if (isset($this->list[$layer])) {
                        unset($this->list[$layer]);
                    }
                }
            } elseif (isset($this->list[$layers])) {
                unset($this->list[$layers]);
            }
        }

        return $this;
    }

    /**
     * Add list of layers in map
     *
     * @access public
     * @param Map $map Map
     * @return void
     */
    public function addTo(Map &$map)
    {
        if (!empty($this->list)) {
            $map->options['layers'] = $this->list;
        }
    }
}