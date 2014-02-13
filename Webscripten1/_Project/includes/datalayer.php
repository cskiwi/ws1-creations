<?php
/**
 * Created by PhpStorm.
 * User: Glenn
 * Date: 12/19/13
 * Time: 10:11 AM
 */

/**
 * Includes
 */

// includes
require_once __DIR__ . DIRECTORY_SEPARATOR . 'functions.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . 'config.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . 'Marker.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . 'Route.php';

/**
 * DataLayer Class
 *
 * @author    Rogier van der Linde <rogier.vanderlinde@kahosl.be> (updated by Glenn Latomme <glenn.latomme@hubkaho.be>
 */

class DataLayer {

    /**
     * Database connection handler
     */
    var $link;

    /**
     * Class constructor.
     */
    public function __construct() {
        $this->link = @mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME) or showError(mysqli_connect_error($this->link), 'connect');
    }


    /**
     * -------------
     * |  MARKERS  |
     * -------------
     */


    /**
     * Delete a marker
     *
     * @param	int 	$id The id of the marker to delete
     * @return	void
     */
    public function deleteMarker($id) {
        // build query
        $query = sprintf('DELETE FROM markers WHERE id = %d',
            (int) $id
        );

        // execute query
        @mysqli_query($this->link, $query) or showError(mysqli_error($this->link), 'query');

        // check if marker to delete was found
        if (@mysqli_affected_rows($this->link) == 0) {
            showError('marker with id ' . $id . 'not found', 'query');
        }
    }

    /**
     * Checks whether a marker exists or not
     *
     * @param	int 		$id Id of the marker
     * @return	bool
     */
    public function existsMarker($id) {
        // build query
        $query = sprintf('SELECT * FROM markers WHERE id = %d',
            (int) $id
        );

        // execute query
        $result = @mysqli_query($this->link, $query) or showError(mysqli_error($this->link), 'query');

        // return result
        return mysqli_num_rows($result) == 1;
    }

    /**
     * Get a marker by id
     *
     * @param	int 		$id Id of the marker
     * @return	array
     */
    public function getMarker($id) {
        // build query
        $query = sprintf('SELECT * FROM markers WHERE id = %d',
            (int) $id
        );

        // execute query
        $result = @mysqli_query($this->link, $query) or showError(mysqli_error($this->link), 'query');

        // result found?
        if (!($record = @mysqli_fetch_array($result))) showError('marker with id ' . $id . ' not found', 'query');

        // return result
        return new Marker($record['id'], $record['routeID'], $record['locX'], $record['locY']);
    }

    /**
     * Get all markers
     *
     * @param int $routeId
     * @param	string[optional] 	$orderBy Field to sort markers on
     * @return	array
     */
    public function getMarkers($routeId, $orderBy = 'id') {
        // results array
        $markers = array();

        // build query
        $query = sprintf('SELECT * FROM markers WHERE routeID = %s ORDER BY %s',
            (int) $routeId,
            mysqli_real_escape_string($this->link, $orderBy)
        );

        // execute query
        $result = @mysqli_query($this->link, $query) or showError(mysqli_error($this->link), 'query');

        // add results
        while ($record = mysqli_fetch_array($result)) {
            $markers[] = new Marker($record['id'], $record['routeID'], $record['locX'], $record['locY']);
        }

        // return results
        return $markers;
    }

    /**
     * Insert a marker
     *
     * @param	Marker 	$marker The marker to insert
     * @return	int 		the id of the marker inserted
     */
    public function insertMarker($marker) {
        // build query
        $query = sprintf('INSERT INTO markers (locX, locY, routeID) VALUES ("%f", "%f", "%d")',
            (float)$marker->locX,
            (float)$marker->locY,
            (int) $marker->routeID
        );

        // execute query
        @mysqli_query($this->link, $query) or showError(mysqli_error($this->link), 'query');

        // return id
        return mysqli_insert_id($this->link);
    }

    /**
     * Update a marker
     *
     * @param	Marker 	$marker The marker to update
     * @return	void
     */
    public function updateMarker($marker) {
        // build query
        $query = sprintf('UPDATE markers SET locX = "%d", locY = "%d", routeID = "%d" WHERE id = %d',
            (float) $marker->locX,
            (float) $marker->locY,
            (int) $marker->routeID,
            (int) $marker->id
        );

        // execute query
        $result = @mysqli_query($this->link, $query) or showError(mysqli_error($this->link), 'query');

        // check if marker to update was found
        // if (@mysqli_affected_rows($this->link) == 0) {
        if ($result === false) {
            showError('marker with id ' . $marker->id . ' not found', 'query');
        }
    }

    /**
     * ------------
     * |  ROUTES  |
     * ------------
     */


    /**
     * Delete a Route
     *
     * @param	int 	$id The id of the marker to delete
     * @return	void
     */
    public function deleteRoute($id) {
        // build query
        $query = sprintf('DELETE FROM routes WHERE id = %d',
            (int) $id
        );

        // execute query
        @mysqli_query($this->link, $query) or showError(mysqli_error($this->link), 'query');

        // check if marker to delete was found
        if (@mysqli_affected_rows($this->link) == 0) {
            showError('marker with id ' . $id . 'not found', 'query');
        }
    }

    /**
     * Checks whether a route exists or not
     *
     * @param	int 		$id Id of the marker
     * @return	bool
     */
    public function existsRoute($id) {
        // build query
        $query = sprintf('SELECT * FROM routes WHERE id = %d',
            (int) $id
        );

        // execute query
        $result = @mysqli_query($this->link, $query) or showError(mysqli_error($this->link), 'query');

        // return result
        return mysqli_num_rows($result) == 1;
    }

    /**
     * Get a marker by id
     *
     * @param	int 		$id Id of the marker
     * @return	array
     */
    public function getRoute($id) {
        // build query
        $query = sprintf('SELECT * FROM routes WHERE id = %d',
            (int) $id
        );

        // execute query
        $result = @mysqli_query($this->link, $query) or showError(mysqli_error($this->link), 'query');

        // result found?
        if (!($record = @mysqli_fetch_array($result))) showError('route with id ' . $id . ' not found', 'query');

        // return result
        return new Route($record['id'], $record['name']);
    }

    /**
     * Get all markers
     *
     * @param	string[optional] 	$orderBy Field to sort markers on
     * @return	array
     */
    public function getRoutes($orderBy = 'id') {
        // results array
        $routes = array();

        // build query
        $query = sprintf('SELECT * FROM routes ORDER BY %s',
            mysqli_real_escape_string($this->link, $orderBy)
        );

        // execute query
        $result = @mysqli_query($this->link, $query) or showError(mysqli_error($this->link), 'query');

        // add results
        while ($record = mysqli_fetch_array($result)) {
            $routes[] = new Route($record['id'], $record['name']);
        }

        // return results
        return $routes;
    }

    /**
     * Insert a marker
     *
     * @param	Marker 	$route The marker to insert
     * @return	int 		the id of the marker inserted
     */
    public function insertRoute($route) {
        // build query
        $query = sprintf('INSERT INTO routes (name) VALUES ("%s")',
            mysqli_real_escape_string($this->link, $route->name)
        );

        foreach($route->getMarkers() as $marker) {
            $this->insertMarker($marker);
        }

        // execute query
        @mysqli_query($this->link, $query) or showError(mysqli_error($this->link), 'query');

        // return id
        return mysqli_insert_id($this->link);
    }

    /**
     * Update a marker
     *
     * @param	Marker 	$route The marker to update
     * @return	void
     */
    public function updateRoute($route) {
        // build query
        $query = sprintf('UPDATE routes SET name = "%s" WHERE id = %d',
            mysqli_real_escape_string($this->link, $route->name),
            (int) $route->id
        );

        // execute query
        $result = @mysqli_query($this->link, $query) or showError(mysqli_error($this->link), 'query');

        // check if marker to update was found
        // if (@mysqli_affected_rows($this->link) == 0) {
        if ($result === false) {
            showError('marker with id ' . $route->id . ' not found', 'query');
        }
    }

    /**
     * Find the maximum value of a field; returns null if not found
     *
     * @param	string 	$table The table name
     * @param	string 	$field The field to look in
     * @return	mixed
     */
    public function getMaxVal($table, $field) {
        // build query
        $query = sprintf('SELECT MAX(%s) FROM %s',
            mysqli_real_escape_string($this->link, $field),
            mysqli_real_escape_string($this->link, $table)
        );

        // execute query
        $result = @mysqli_query($this->link, $query) or showError(mysqli_error($this->link), 'query');

        // result found?
        if (!($record = @mysqli_fetch_array($result))) return null;

        // return result
        return $record[0];
    }
}