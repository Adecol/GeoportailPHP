# Geoportail Package

## Vars of Geoportail

| Name | Type | Description |
|------|------|------|
| id | string | id of div to display and id of map |
| api | string | type of api |
| key | string | key of IGN.fr |
| center | string or array | center of map (see below) |
| zoom | int | |
| options | array | Options of map (see below) |
| overlays | array | Overlays of map (see below) |
| functions | array | List of functions (see below) |

### Center

| Name | Type | Description |
|------|------|------|
| gps | array | lon and lat |
| address | string | |
| place | string | |
| OpenLayers | string | Object with lon and lat |
| geolocate | boolean | true for HTML5 geolocalization |

### Options

| Name | Type | Description |
|------|------|------|
| language | string | fr, en |
| type | string | js |
| overlays | boolean | display or not the marker defined by the center |
| label | string | label of marker |
| description | string | description of marker |
| viewerClass | string | Default or Standard or Mobile |
| layers | array | list of layers from Geoportail, "all" => all layers |
| layersOptions | array | list of layersOptions (see below) |
| displayProjection | string | Type of projection |
| proxyURL | string | Proxy |

### layersOptions

| Name | Type | Description |
|------|------|-------------|
| visibility | boolean | Visibility by default of layer |
| opacity | numeric | Opacity of layer |

### Overlays

| Name | Type | Description |
|------|------|-------------|
| type | string | KML, GEORSS, WMS… |
| name | string | Name of overlay |
| url | string | Path of file |
| param_layer | array | Param layer (see below) |
| param_popup | array | Param popup (see below) |
| param_service | array | Param service (see below) |

### Functions

| Name | Type | Description |
|------|------|-------------|
| pan | array | x and y |

### Param layer by default

| Name | Type | Description |
|------|------|-------------|
| visibility | boolean | Displays by default the layer |
| opacity | numeric | Opacity |
| minZoomLevel | int | between 0 and 21 |
| maxZoomLevel | int | between 0 and 21 |
| format | string  | OpenLayers.Format.KML, OpenLayers.Format.GPX, OpenLayers.Format.OSM… |
| maxExtend | string | OpenLayers.Bounds(-180,-90,180,90) |
| styleMap | ??? | |
| view | ??? | |
| originators | array | Originators (see below) |
| isBaseLayer | boolean | if true, it's the base |
| eventListeners | string | event on the map |
| constraints | ??? | |

### Param popup by default

| Name | Type | Description |
|------|------|-------------|
| onSelect | string | Function on select |
| onUnselect | string | Function on unselect |
| hover | ??? | |
| preventDefaultBehavior | boolean | if true, no popup |

### Originators

| Name | Type | Description |
|------|------|-------------|
| logo | string | Identifiant of picture |
| pictureUrl | string | Url of picture |
| url | string | Url of originators |
| extent | ??? | |
| attribution | string | description of originators |



# Layers

ADMINISTRATIVEUNITS.BOUNDARIES
AEROPORT_SYMBO_PYR-PNG_WLD_WM_2013-03-28
ALLUVIONS-RECENTS_SYMBO_PYR-PNG_FXX_WM_20120807
AREAMANAGEMENT.ZFU
AREAMANAGEMENT.ZUS
BATI_SYMBO_PYR-PNG_WLD_20120704 : batiments travaux
BATI_SYMBO_PYR-PNG_WLD_20130131
BATI_SYMBO_PYR-PNG_WLD_20130204
BDALTI_PYR-JPEG_WLD_WM_WMTS_20120617 : Altitude
BDALTI_PYR-JPEG_WLD_WM_WMTS_20120618 : Relief