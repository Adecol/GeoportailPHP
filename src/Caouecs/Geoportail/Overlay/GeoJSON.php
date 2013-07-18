<?php namespace Caouecs\Geoportail\Overlay;

use \Caouecs\Geoportail\Map;
use \Caouecs\Geoportail\Helpers;

class GeoJSON {

    /**
     * Name of overlays
     *
     * @access protected
     * @var string
     */
    protected $name = null;

    /**
     * Path of overlays
     *
     * @access protected
     * @var string
     */
    protected $path = null;


    /**
     * Construct
     *
     * @access public
     * @param string $name Name of overlays
     * @param string $path Path of overlays
     * @return void
     */
    public function __construct($name, $path)
    {
        $this->name = Helpers::protectString($name);
        $this->path = (string) $path;
    }

    /**
     * Construct
     *
     * @access public
     * @param string $name Name of overlays
     * @param string $path Path of overlays
     * @return GeoJSON
     */
    public static function create($name, $path)
    {
        return new GeoJSON($name, $path);
    }

    /**
     * Add to map
     *
     * @access public
     * @param Map $map Map
     * @return void
     *
     * @todo Get data from geojson
     */
    public function addTo(Map &$map)
    {
        $tmp = ' var vlayer = new OpenLayers.Layer.Vector("'.$this->name.'");
            var options_geojson = {
                "internalProjection": iv_'.$map->getID().'.getMap().getProjection(),
                "externalProjection": new OpenLayers.Projection("EPSG:4326")
            };
            var json_format = new OpenLayers.Format.GeoJSON(options_geojson);
            var data = "";

            var vector_layer = iv_'.$map->getID().'.getMap().getLayersByName("'.$this->name.'")[0];
            vector_layer.addFeatures(json_format.read(data));
            iv_'.$map->getID().'.getMap().addLayer(vector_layer); ';

        $map->overlays[$this->name] = $tmp;
    }

}



/*

Ie format GeoJSON n'est supporté que par l'api étendue.

1/ Création d'une couche vecteur

var vlayer = new OpenLayers.Layer.Vector("Marqueurs GeoJson")

2/ Création d'une instance de la classe OpenLayers.Format.GeoJSON avec les options suivantes:

var options = {
             "internalProjection": VISU.getMap().getProjection(),
         "externalProjection": new OpenLayers.Projection("EPSG:4326")
};  

var json_format = new OpenLayers.Format.GeoJSON(options);       

3/ Création d'une variable data qui est une chaîne de caractères avec le contenu du fichier JSON.

4/Ajout des features à la couche vecteur:

var vector_layer = VISU.getMap().getLayersByName("Marqueurs GeoJson")[0];
vector_layer.addFeatures(json_format.read(data));

5/ Ajout de cette couche à la carte
VISU.getMap().addLayer(vector_layer);
*/