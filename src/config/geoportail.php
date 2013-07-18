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
    )
);