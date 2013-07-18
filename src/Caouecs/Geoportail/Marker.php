<?php namespace Caouecs\Geoportail;

/**
 * Define marker of Geoportail map
 *
 */
class Marker {

    /**
     * Label of marker
     *
     * @access public
     * @var string
     */
    public $label = null;

    /**
     * Description of marker
     *
     * @access public
     * @var string
     */
    public $description = null;

    /**
     * Options of marker
     *
     * @access public
     * @var array
     */
    public $options = array();

    /**
     * Language of marker
     *
     * @access public
     * @var string
     */
    public $language = null;

    /**
     * Construct
     *
     * @access public
     * @param string $label Label
     * @param string $description Description
     * @param string $language Language
     * @return void
     */
    public function __construct($label = null, $description = null, $language = null)
    {
        $this->setDesc($label, $description, $language);
    }

    /**
     * Create
     *
     * @access public
     * @param string $label Label
     * @param string $description Description
     * @param string $language Language
     * @return \Marker
     */
    public static function create($label = null, $description = null, $language = null)
    {
        return new Marker($label, $description, $language);
    }

    /**
     * Set desc
     *
     * @access public
     * @param string $label Label
     * @param string $description Description
     * @param string $language Language
     * @return \Marker
     */
    public function setDesc($label = null, $description = null, $language = null)
    {
        $this->label = e($label);
        $this->description = $description;

        if (mb_strlen($language) == 2) {
            $this->language = e($language);
        }

        return $this;
    }

    /**
     * Add/Update options
     *
     * @access public
     * @param string $option Option
     * @param string $value Value
     * @return \Marker
     *
     * @todo Verif if "option" exists in Geoportail
     */
    public function setOption($option, $value)
    {
        $this->options[$option] = $value;

        return $this;
    }

    /**
     * Remove options
     *
     * @access public
     * @param string $option Option
     * @return \Marker
     */
    public function removeOption($option)
    {
        if (isset($this->options[$option])) {
            unset($this->options[$option]);
        }

        return $this;
    }

    /**
     * Add to map
     *
     * @access public
     * @param Map $map Map
     * @return void
     */
    public function addTo(Map &$map)
    {
        // label
        if (!empty($this->label)) {
            $map->options['label'] = e($this->label);
        }

        // description
        if (!empty($this->description)) {
            $map->options['description'] = e($this->description);
        }

        // options
        if (!empty($this->options)) {
            $map->options['marker'] = json_encode($this->options);
        }
    }
}