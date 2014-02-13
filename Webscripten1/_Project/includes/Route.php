<?php
/**
 * Created by PhpStorm.
 * User: Glenn
 * Date: 12/19/13
 * Time: 12:03 PM
 */

class Route {
    public $id;
    public $name;
    public $markers;

    /**
     * @param mixed $marker
     */
    public function addMarker($marker)
    {
        array_push($this->markers, $marker);
    }

    /**
     * @return array
     */
    public function getMarkers()
    {
        return $this->markers;
    }


    /**
     * @param int $id
     * @param String $name
     */
    function __construct($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
        $this->markers = Array();
    }


} 