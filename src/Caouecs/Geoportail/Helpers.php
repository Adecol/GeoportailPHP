<?php namespace Caouecs\Geoportail;

class Helpers {

    /**
     * Validation of array with a validator
     *
     * @access public
     * @param array $array Array to tested
     * @param array $validator Validator
     * @return array
     */
    public static function validArray($array, $validator)
    {
        $return = null;

        /**
         * Definition $validator = array(
         *      0 => type of value,
         *      1 => value by default,
         *      2 => options
         * )
         */

        foreach ($array as $key => $value) {

            // verif if it's in validator
            if (array_key_exists($key, $validator)) {
                $type = isset($validator[$key][0]) ? $validator[$key][0] : "string";
                // verif value
                switch ($type) {
                    // Boolean
                    case "bool":
                    case "boolean":

                        if (!isset($validator[$key][1]) || !is_bool($validator[$key][1])) {
                            $validator[$key][1] = false;
                        }

                        $return[$key] = is_bool($value) ? $value : $validator[$key][1];
                        break;

                    // Integer
                    case "int":
                    case "integer":
                        if ( is_int($value) ) {
                            if (
                                (isset($validator[$key][2]['min']) && $value < $validator[$key][2]['min'])
                                 || 
                                (isset($validator[$key][2]['max']) && $value > $validator[$key][2]['max'])
                            ) {
                                $return[$key] = (int) $validator[$key][1];
                            } else {
                                $return[$key] = (int) $value;
                            }
                        }
                        break;

                    // Array
                    case "array":
                        if (is_array($value)) {
                            if (is_array($validator[$key][2])) {
                                $value = self::validArray($value, $validator[$key][2]);
                            }
                            if (is_array($value)) {
                                $return[$key] = $value;
                            }
                        }
                        break;

                    // Data
                    case "data":
                        $return[$key] = $value;
                        break;

                    // String
                    case "string":
                    // Default
                    default:
                        $return[$key] = e($value);
                }
            }
        }

        return $return;
    }

   /**
     * Add value in an array
     *
     * @access public
     * @param array $array Array object
     * @param string $value Value to add
     * @param string $key Array key to use
     * @return array
     */
    public static function add_class($array, $value, $key = 'class')
    {
        $array[$key] = isset($array[$key]) ? $array[$key].' '.$value : $value;

        return $array;
    }
}