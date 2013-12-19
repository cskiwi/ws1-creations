/**
 * Created by Glenn on 12/19/13.
 */
var map;
var route;
var routes;
var elevator;
var elevations = [];
var distances = [];
var markers = [];
var LastRouteId;

$("#save-route").click(function(){
    var name = $('#save-text').val();

    if (route.getPath().length <= 0) {
        $('#feedback').text('Please add points first');
        return;
    }
    if (name == '') {
        $('#feedback').text('Please enter a name');
        return;
    }

    var data = route.getPath();
    data.name = name;
    var routedata = JSON.stringify(data);
    // console.log(routedata);
    $.get(
        'includes/api.php',
        { input: routedata}
    ).done (function (result) {
        var a = JSON.parse(result);
        console.log(a);
        LastRouteId = parseInt(a[0].lastRouteID);
        $('#feedback').text(a[1].Message + ' ' + name);
        $('#saved-routes').append(new Option(name, LastRouteId));
    });
});
$('#clear-route').click(function(){
    clearMarkers();
});
$('#load-route').click(function(){
    if ($('#saved-routes').val() != -1) {
        clearMarkers();

        // get ID
        $.get(
            'includes/api.php',
            {
                request: 'route',
                id: $('#saved-routes').val()
            }
        ).done (function (result) {
            var a = JSON.parse(result);
            console.log(a);

            r = a[0];
            // route = null;
            for (var i = 0; i < r.markers.length; i++){
                addMarker(r.markers[i].locX, r.markers[i].locY);
            }
            $('#feedback').html(a[1].Message);
        });
    } else {
        $('#feedback').text('Please select a route');
    }
});


function initialize() {
    var mapOptions = {
        zoom: 18,
        center: new google.maps.LatLng(27.9881, 86.9253),
        panControl: false,
        zoomControl: true,
        mapTypeControl: false,
        scaleControl: false,
        streetViewControl: false,
        overviewMapControl: false
    };
    var routeOptions = {
        strokeColor: '#000000',
        strokeOpacity: 1.0,
        strokeWeight: 1
    };
    elevator = new google.maps.ElevationService();
    map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
    route = new google.maps.Polyline(routeOptions);
    route.setMap(map);

    google.maps.event.addListener(map, 'click', click);

    // chart
    $("#height-map").dxChart({
        dataSource: elevations,
        commonSeriesSettings: {
            argumentField: 'distancePassed'
        },
        series: [{
            name: 'Elevation',
            valueField: 'elevation'
        }],
        tooltip: {
            enabled: true,
            format: 'fixedPoint',
            argumentFormat: 'fixedPoint',
            precision: 2,
            connector: {
                visible: true
            },
            customizeText: function (e) {
                return  "Height: " + e.valueText + " m\nDistance: " + e.argumentText + " m";
            }
        },
        legend: {
            visible: false
        },
        valueAxis: {
            title : "Height (m)"
        },
        argumentAxis: {
            title : "Distnace (m)",
            grid: { visible: true }
        },
        animation: {
            enabled: false
        }

    });

    $.get(
        'includes/api.php',
        {
            request: 'routes'
        }
    ).done (function (result) {
        var a = JSON.parse(result);
        console.log(a);

        routes = a[0];
        for (var i = 0; i < routes.length; i++){$
            if (routes[i]['id'] > LastRouteId){
                LastRouteId = routes[i]['id'];
            }
            $('#saved-routes').append(new Option(routes[i]['name'],routes[i]['id']));
        }

    });
}

function clearMarkers(){
    route.setPath([]);
    for(var i = 0; i < markers.length; i++){
        markers[i].setMap(null);
    }
    elevations = [];
    distances = [];
    updatedChart();
}
function click(event) {
    addMarker(event.latLng.nb, event.latLng.ob);
}

function addMarker(x, y) {
    placeMarker(x, y);
    updateDistance();
    updateElevation();
}
function placeMarker(x, y) {
    var path = route.getPath();
    var point = new google.maps.LatLng(x, y);
    path.push(point);

    var marker = new google.maps.Marker({
        position: point,
        map: map
    });
    markers.push(marker);
}
// distances array build up with length between point 1 -> 2, 2 -> 3, ...
// length is -1 nr of points
function updateDistance() {
    var locations = route.getPath();
    if (locations.length > 1) {
        distances.push(google.maps.geometry.spherical.computeDistanceBetween(locations.getAt(locations.length-2),locations.getAt(locations.length-1)));
    }
}

function updatedChart(){
    $("#height-map").dxChart('option','dataSource',elevations);
}

function updateElevation() {
    var locations = route.getPath();
    var positionalRequest = {
        'locations': [locations.getAt(locations.length-1)]
    }

    elevator.getElevationForLocations(positionalRequest, function(results, status) {
        if (status == google.maps.ElevationStatus.OK && results[0]) {
            elevations.push(results[0]);
            elevations[elevations.length-1].distancePassed = (elevations[0].distancePassed == null)? 0 : elevations[elevations.length-1].distancePassed = elevations[elevations.length-2].distancePassed + distances[elevations.length-2];
            updatedChart();
        } else {
            alert("Elevation service failed due to: " + status);
        }
    });
}
google.maps.event.addDomListener(window, 'load', initialize);