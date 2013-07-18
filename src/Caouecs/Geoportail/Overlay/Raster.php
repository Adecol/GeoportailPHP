<?php namespace Caouecs\Geoportail\Overlay;

class Raster extends Core {

    /**
     * Verif datas of param_layer
     *
     * @param array $param_layer Params of layer
     * @return array
     */
    public static function verifParamLayer($param_layer)
    {
        return File::verifParamLayer($param_layer);
    }
}