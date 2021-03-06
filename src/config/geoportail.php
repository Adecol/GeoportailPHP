<?php

/**
 * Configuration of Geoportail
 *
 */

return array(
    // key of your Geoportail account
    'key' => 'ldeqx1o1i0uxwp1wvt8yn0oa',

    // language of tools
    'language' => 'fr',

    // center
    'center' => array(
        "type" => "place",
        "value" => "France"
    ),

    // params of canvas
    'canvas' => array(
        'width' => "100%",
        'height' => "600px"
    ),

    // urls of assets
    'asset' => array(
        'js' => 'http://api.ign.fr/geoportail/api/js/2.0.3'
    ),

    // types of api of Geoportail
    'api' => array(
        "default", "min", "extended"
    ),

    // layers by default
    'layers' => array(
        'ORTHOIMAGERY.ORTHOPHOTOS', 'GEOGRAPHICALGRIDSYSTEMS.MAPS', 'ADMINISTRATIVEUNITS.BOUNDARIES', 'BUILDINGS.BUILDINGS', 'ELEVATION.SLOPES', 'GEOGRAPHICALNAMES.NAMES', 'HYDROGRAPHY.HYDROGRAPHY', 'ELEVATION.LEVEL0', 'TRANSPORTNETWORKS.RAILWAYS', 'TRANSPORTNETWORKS.ROADS', 'TRANSPORTNETWORKS.RUNWAYS', 'UTILITYANDGOVERNMENTALSERVICES.ALL', 'StreetAddress', 'CADASTRALPARCELS.PARCELS', 'PositionOfInterest'
    )
);