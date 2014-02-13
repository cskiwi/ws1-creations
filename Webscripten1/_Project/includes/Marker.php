<?php
/**
 * Created by PhpStorm.
 * User: Glenn
 * Date: 12/19/13
 * Time: 9:59 AM
 */

class Marker {

    /**
     * public members
     */
    public $id;
    public $locX;
    public $locY;
    public $routeID;

    /**
     * @param int $id = the ID
     * @param int $routeID = what route it belongs
     * @param double $locX = X Location on the map
     * @param double $locY = Y Location on the map
     */
    function __construct($id, $routeID, $locX, $locY) {
        $this->id = $id;
        $this->routeID = $routeID;
        $this->locX = $locX;
        $this->locY = $locY;
    }


}