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
var infomarkers = [];
var LastRouteId;
var xhr;
var maxHeight = 0;
var minHeight = 0;

var feedback = $('#feedback');
var heightmap = $("#height");
var load_routes = $('#load-routes');

$("#save-route").click(function(){
    var name = $('#save-text').val();

    if (route.getPath().length <= 0) {
        feedback.text('Please add points first');
        feedback.fadeIn().delay(1000).fadeOut();
        return;
    }
    if (!name.match(/^(?=.*[A-Z0-9])[\w.,!"'\/$ ]+$/i)) {
        feedback.text('Please enter valid a name');
        feedback.fadeIn().delay(1000).fadeOut();
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
        // console.log(a);
        LastRouteId = parseInt(a[0].lastRouteID);
        feedback.text(a[1].Message + ' ' + name);
        feedback.fadeIn().delay(1000).fadeOut();
        load_routes.append(new Option(name, LastRouteId));
        getPictures();
    });
});
$('#clear-route').click(function(){
    clearMarkers();
});

$('#load-route').click(function(){
    if (load_routes.val() != -1) {
        clearMarkers();
        // get ID
        $.get(
            'includes/api.php',
            {
                request: 'route',
                id: load_routes.val()
            }
        ).done (function (result) {
            var a = JSON.parse(result);
            // console.log(a);

            var r = a[0];
            // route = null;
            for (var i = 0; i < r.markers.length; i++){
                addMarker(r.markers[i].locX, r.markers[i].locY);
            }
            getPictures();
            feedback.text(a[1].Message);
            feedback.fadeIn().delay(1000).fadeOut();
            map.setCenter(markers[0]['position']);
        });
    } else {
        feedback.text('Please select a route');
        feedback.fadeIn().delay(1000).fadeOut();
    }
});


function initialize() {
    var mapOptions = {
        zoom: 18,
        center: new google.maps.LatLng(46.739424, 9.598991),
        panControl: false,
        zoomControl: false,
        mapTypeControl: false,
        scaleControl: false,
        streetViewControl: false,
        overviewMapControl: false,
        mapTypeId: google.maps.MapTypeId.SATELLITE
    };
    var routeOptions = {
        strokeColor: 'cadetblue',
        strokeOpacity:0.75,
        strokeWeight: 3
    };

    xhr = new XMLHttpRequest();
    elevator = new google.maps.ElevationService();
    map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
    route = new google.maps.Polyline(routeOptions);
    route.setMap(map);

    google.maps.event.addListener(map, 'click', click);

    // chart
    heightmap.children('#height-map').dxChart({
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
            title : "Distance (m)",
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
        // console.log(a);

        routes = a[0];
        for (var i = 0; i < routes.length; i++){$
            if (routes[i]['id'] > LastRouteId){
                LastRouteId = routes[i]['id'];
            }
            load_routes.append(new Option(routes[i]['name'],routes[i]['id']));
        }

    });

    $('.fancybox').fancybox({
        openEffect	: 'none',
        closeEffect	: 'none'
    });

    xhr.onreadystatechange = function(e) {
        try {
            var data = JSON.parse(this.responseText);
            data = data.photos.photo;
            var picDiv = $('<div>');
            picDiv.attr('id', 'locationPictures');
            for (var i = 0; i < data.length; i++) {
                var img = $('<img>');
                var a = $('<a>');
                img.attr('src', data[i].url_m);
                img.addClass('box-shadow');
                img.addClass('locationPic');
                a.attr('href', data[i].url_m);
                a.addClass('fancybox');
                img.appendTo(a);
                a.appendTo(picDiv);
            }
            var infowindow = new google.maps.InfoWindow({
                content: picDiv.outerHTML()
            });
            infowindow.open(map, markers[0]);

            google.maps.event.addListener(markers[0], 'click', function() {
                infowindow.open(map,markers[0]);
            });
        } catch (e) {
        }
    }
}

function clearMarkers(){
    route.setPath([]);
    for(var i = 0; i < markers.length; i++){
        markers[i].setMap(null);
    }
    for(var i = 0; i < infomarkers.length; i++){
        infomarkers[i].setMap(null);
    }
    elevations = [];
    distances = [];
    markers = [];
    updatedChart();
}
function click(event) {
    // console.log(event);

    addMarker(event.latLng.b, event.latLng.d);
}

function addMarker(x, y) {
    // console.log(x, y);
    placeMarker(x, y);
    updateDistance();
    updateElevation();
}
function placeMarker(x, y) {
    var path = route.getPath();
    var point = new google.maps.LatLng(x, y);
    path.push(point);
    var icon = (markers.length < 1) ? 'http://maps.google.com/mapfiles/ms/icons/yellow-dot.png' : 'http://maps.google.com/mapfiles/ms/icons/red-dot.png';
    var marker = new google.maps.Marker({
        position: point,
        map: map,
        icon: icon
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
    if (markers.length > 0) {
        var diff = maxHeight - minHeight;
        heightmap.fadeIn()
            .children('#height-map').dxChart('option','dataSource',elevations).parent()
            .children('#heightdiff').text('Height difference: ' + diff + 'm' );
    } else if (heightmap.is(":visible")){
        heightmap.fadeOut();
    }
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

            console.log(results[0]['elevation'] + 'min:' + minHeight + ', max:' +maxHeight );

            if (results[0]['elevation'] > maxHeight || maxHeight == 0)
                maxHeight = results[0]['elevation'];
            if (results[0]['elevation'] < minHeight || minHeight == 0)
                minHeight = results[0]['elevation'];

            updatedChart();
        } else {
            alert("Elevation service failed due to: " + status);
        }
    });
}


function getPictures(){
    // console.log(markers[0]);
    makeSearch(markers[0]['position'].b, markers[0]['position'].d);
}

function makeSearch(x, y) {
    // console.log("x: " + x  + ", y: " + y );
    var url = "http://api.flickr.com/services/rest/?method=flickr.photos.search" +
        "&extras=url_m,geo&per_page=20&format=json&nojsoncallback=1&safe_search=1";
    url += '&api_key=6ecfcd8d4a3b8a04da6093733db989a2';
    url += '&lat=' + x;
    url += '&lon=' + y ;
    url += '&radius=2' ;
    url = encodeURI(url);
    xhr.open("GET", url, true);
    xhr.send()
}

jQuery.fn.outerHTML = function() {
    return jQuery('<div />').append(this.eq(0).clone()).html();
};
google.maps.event.addDomListener(window, 'load', initialize);

// Function to get the Max value in Array
Array.max = function( array ){
    return Math.max.apply( Math, array );
};

// Function to get the Min value in Array
Array.min = function( array ){
    return Math.min.apply( Math, array );
};