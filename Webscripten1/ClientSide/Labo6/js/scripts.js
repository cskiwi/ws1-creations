/**
 * Falling cube script
 *
 * @author Rogier van der Linde <rogier.vanderlinde@kahosl.be>
 */
var color1  = 0x0000FF;
var color2  = 0xFF0000;
var curColor = color1;

// scene
var camera, scene, renderer;

// the game bottom plane
var plane;

// the sphere
var cubes = [];
var cubeSize = 50;

var boingBuffer = null;
var context;
/**
 * Initializes the game
 *
 */
var init = function() {
    try {
        // Fix up for prefixing
        window.AudioContext = window.AudioContext||window.webkitAudioContext;
        context = new AudioContext();
    }
    catch(e) {
        alert('Web Audio API is not supported in this browser');
    }

    loadBoingSound('./snd/boing.wav');

    // scene
    scene = new THREE.Scene();

    // camera
    camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 1, 10000);
    camera.position.set(0, 500, 500);

    // spotlight 1
    var spotlight1 = new THREE.SpotLight();
    spotlight1.position.set(1000, 600, 500);
    spotlight1.target.position.set(0, 0, 0);
    spotlight1.castShadow = true;
    scene.add(spotlight1);

    var spotlight2 = new THREE.SpotLight();
    spotlight2.position.set(-1000, 600, 500);
    spotlight2.target.position.set(0, 0, 0);
    spotlight2.castShadow = true;
    scene.add(spotlight2);

    // plane
    plane = new THREE.Mesh(
        new THREE.PlaneGeometry(1200, 600, 8, 8),
        new THREE.MeshLambertMaterial({ color: 0xffcc55, wireframe: false })
    );
    plane.position.set(0, 0, 0);
    plane.castShadow = false;
    plane.receiveShadow = true;
    plane.rotation.x = -Math.PI / 2;
    scene.add(plane);

    // aim camera
    camera.lookAt(plane.position);

    // renderer
    renderer = new THREE.WebGLRenderer({ antialias: true });
    renderer.setSize(window.innerWidth, window.innerHeight);
    renderer.shadowMapEnabled = true;
    document.getElementById('viewport').appendChild(renderer.domElement);
}

function createCubus(loc){
    // add cube
    var cube = new THREE.Mesh(
        new THREE.CubeGeometry(cubeSize, cubeSize, cubeSize),
        new THREE.MeshLambertMaterial( { color: curColor } )
    );

    // find destination Y pos
    var yCol = cubeSize/2;
    for (var j = 0; j < cubes.length; j++){
        if (cubes[j].position.x == loc){
                yCol += cubeSize;
        }
    }

    cube.castShadow = true;
    cube.position.set(loc, 500, 0);
    cube.canFall = true;
    cube.speedY = 0;
    cube.color = curColor; // for checking 4 same
    cube.yCol = yCol;

    cube.col = (loc+125)/cubeSize +1;
    cube.row = (yCol+ cubeSize/2)/cubeSize ;

    scene.add(cube);
    cubes.push(cube);
    curColor = curColor == color1 ? color2 : color1;
}

window.addEventListener('load', function() {
    document.getElementById('cube1').addEventListener('click', function() {
        createCubus(-125);
    });
    document.getElementById('cube2').addEventListener('click', function() {
        createCubus(-75);
    });
    document.getElementById('cube3').addEventListener('click', function() {
        createCubus(-25);
    });
    document.getElementById('cube4').addEventListener('click', function() {
        createCubus(25);
    });
    document.getElementById('cube5').addEventListener('click', function() {
        createCubus(75);
    });
    document.getElementById('cube6').addEventListener('click', function() {
        createCubus(125);
        console.log(cubes);
    });

});

function loadBoingSound(url) {
    var request = new XMLHttpRequest();
    request.open('GET', url, true);
    request.responseType = 'arraybuffer';

    // Decode asynchronously
    request.onload = function() {
        context.decodeAudioData(request.response, function(buffer) {
            boingBuffer = buffer;
        }, function(e){
            console.log(e);
        });
    }
    request.send();
}

/**
 * Render & tick the scene
 *
 */
var render = function() {
    renderer.render(scene, camera);
}

function tick() {
    var accY = -4;
    var damping = 0.7;

    for (var i = 0; i < cubes.length; i++){
        var cube = cubes[i];
        if (cube.canFall){
            // update animation
            cube.speedY += accY;
            cube.position.y += cube.speedY;

            // check if can fall


            // stop cube when value is done
            if (cube.position.y <= cube.yCol){
                cube.position.y = cube.yCol;
                cube.speedY = -cube.speedY * damping;
                playSound(boingBuffer);
                if (Math.abs(cube.speedY) < 20){
                    cube.canFall = false;
                    cube.position.y = cube.yCol;
                    checkCubes();
                }
            }
        }
    }
}
function checkCubes(){
    for (var i  = 0; i < cubes.length; i++){
        for (var j = 0; j < cubes.length; j++){
            if (i != j){

            }
        }
    }
}

function playSound(buffer) {
    var source = context.createBufferSource(); // creates a sound source
    source.buffer = buffer;                    // tell the source which sound to play
    source.connect(context.destination);       // connect the source to the context's destination (the speakers)
    source.start(0);                           // play the source now
}

function animate(){
    requestAnimationFrame( animate );
    tick();
    render();
}
// start your engines!
init();
animate();
