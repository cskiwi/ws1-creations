<?php
/**
 * Created by PhpStorm.
 * User: Glenn
 * Date: 12/19/13
 * Time: 9:58 AM
 */
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'datalayer.php';
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'marker.php';
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'route.php';

$db = new DataLayer();

if(isset($_GET['input']))
{
    $return = Array();
    $latestMarkerId = $db->getMaxVal('markers', 'id');
    $latestRouteId = $db->getMaxVal('routes', 'id');

    // if no values in database, insert, get ID, recheck index
    if ($latestMarkerId == null) {
        $marker = new Marker(0, 0 ,0,0);
        $db->insertMarker($marker);
        $latestMarkerId = $db->getMaxVal('markers', 'id');
        $db->deleteMarker($latestMarkerId);
    }
    if ($latestRouteId == null) {
        $route = new Route(0, "");
        $db->insertRoute($route);
        $latestRouteId = $db->getMaxVal('routes', 'id');
        $db->deleteRoute($latestRouteId);
    }
    $latestRouteId++;
    $string = json_decode($_GET['input'],true);
    $route = new Route($latestRouteId, $string['name']);

    foreach($string['b'] as $loc) {
        $marker = new Marker($latestMarkerId, $route->id ,$loc['nb'],$loc['ob']);
        $route->addMarker($marker);
        $latestMarkerId++;
    }
    $db->insertRoute($route);
    // $latestRouteId++;

    array_push ($return, Array("lastRouteID" => $latestRouteId));
    array_push ($return, Array("Message" => "Sucessfully saved"));
    echo json_encode($return);
}

if(isset($_GET['request'])){
    $return = Array();
    switch($_GET['request']) {
        case "routes":
            array_push ($return, $db->getRoutes());
            array_push ($return, Array("Message" => "Sucessfully returned all routes"));
            echo json_encode($return);
            break;
        case "route":
            if(isset($_GET['id'])){
                $id = $_GET['id'];
                $route = $db->getRoute($id);
                foreach ($db->getMarkers($id) as $marker) {
                    $route->addMarker($marker);
                }
                array_push ($return, $route);
                array_push ($return, Array("Message" => "Sucessfully loaded route"));
                echo json_encode($return);
            }
            break;
    }

}