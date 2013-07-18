<?php namespace Caouecs\Geoportail\Overlay;

use Caouecs\Geoportail\Map;

class Core {

    /**
     * Add to map
     *
     * @access public
     * @param Map $map Map
     * @return void
     */
    public function addTo(Map &$map)
    {
        $tmp = 'viewer.getMap().addLayer("'.$this->type.'",
            "'.$this->name.'",
            "'.$this->path.'"';

        if (!empty($this->param_layer)) {
            $tmp .= ', '.json_encode($this->param_layer);
        }
        if (!empty($this->param_popup)) {
            $tmp .= ', '.json_encode($this->param_popup);
        }
        $tmp .= ');';

        $map->overlays[$this->name] = $tmp;
    }
}