/**
 * Created by Glenn on 13/01/14.
 */
// Create a new instance of an audio object and adjust some of its properties
var audio = new Audio();
audio.src = 'track1.mp3';
audio.controls = true;
audio.autoplay = true;
// Establish all variables that your Analyser will use
var canvas, ctx, source, context, analyser, fbc_array, bars, bar_x, bar_width, bar_height, pies, pielength;
var animationCanvas,animation,centerX,centerY;
var output, inputLength, bardata, piedata, random =[], rot = [], color;
var songs=[], currentSongID;

window.onload = function() {
// Initialize the MP3 player after the page loads all of its HTML into the window
    $('#audio_box').append(audio);
    context = new webkitAudioContext(); // AudioContext object instance
    analyser = context.createAnalyser(); // AnalyserNode method

    canvas = $('#analyser_render')[0];
    ctx = canvas.getContext('2d');

    animationCanvas =  $('<canvas />')
        .attr('id', 'animation')
        .attr('width', $( '#wrapper' ).width())
        .attr('height', $( '#wrapper' ).height());
    animationCanvas.appendTo($('#wrapper'));

    animation = $('#animation')[0].getContext("2d");
    // animation.translate(0.5, 0.5);
    centerX = animationCanvas.width() / 2;
    centerY = animationCanvas.height() / 2;

    // Re-route audio playback into the processing graph of the AudioContext
    source = context.createMediaElementSource(audio);
    source.connect(analyser);
    analyser.connect(context.destination);

    pies = 10;
    random.push(Math.floor((Math.random()*20)+1));
    rot.push(Math.random());
    for (var i = 1; i < pies; i++){
        random.push(random[i-1] + Math.floor((Math.random()*100)+1));
        rot.push(Math.random());
    }
    var last;
    $('ul li a').each(function(){
        songs.push({location: $(this).attr('data-src'), songID: $(this).attr('songID')})
        last = songs[songs.length-1];
        analyze(last);
    });
    $('#songs li').shuffle();

    $("#audio_box audio").bind("ended", function(){
        playSong(currentSongID +1);
    });

    frameLooper();
}

$('#songs li a').click(function(){
    var songID = $(this).attr('songID');
    playSong(songID);
})
$('#debug').click(function(){
    console.log(canvas);
});



function analyze(file){
    ID3.loadTags(file.location, function() {
        var tags = ID3.getAllTags(file.location);
        songs[file.songID].tags = tags;
        $('ul li a[songID='+file.songID+']').text(tags.artist + ' - ' + tags.title);
    });
}

function playSong(id){
    if (id >= songs.length) id = 0;
    if (id < 0) id = songs.length-1;
    currentSongID = id;
    $('#songInfo').text(songs[id].tags.artist + ' - ' + songs[id].tags.title)
    audio.src = songs[id].location;
    audio.play();
}

// frameLooper() animates any style of graphics you wish to the audio frequency
// Looping at the default frame rate that the browser provides(approx. 60 FPS)
function frameLooper(){
    requestAnimationFrame(frameLooper);
    fbc_array = new Uint8Array(analyser.frequencyBinCount);
    analyser.getByteFrequencyData(fbc_array);

    ctx.clearRect(0, 0, canvas.width, canvas.height); // Clear the canvas
    animation.clearRect(0, 0, animationCanvas.width(), animationCanvas.height()); // Clear the canvas

    ctx.fillStyle = 'rgb(0, 127, 255)'; // Color of the bars

    bars = 200;
    bardata = avareageArray(fbc_array, bars);
    for (var i = 0; i < bars; i++) {
        bar_x = i * 2;
        bar_width = 2;
        bar_height = -(bardata[i] / 2);
        ctx.fillRect(bar_x, canvas.height, bar_width, bar_height);

    }
    drawWedge2(centerX, centerY, 30, 0, 360, 'rgba(0, 127, 255, 1)');

    color = 'rgba(0, 127, 255, .9)';
    piedata = avareageArray(fbc_array, pies);
    for (var i = 0; i < pies; i++) {
        pielength = piedata[i]/2;
        drawWedge(centerX, centerY, pielength, random[i] + rot[i], color);
        rot[i] += random[i]/1000;
    }
}
function drawWedge2(centerX, centerY, r, start, end, color) {
    animation.beginPath();
    animation.moveTo(centerX, centerY);
    animation.arc(centerX, centerY, r, d2r(start), d2r(end), false);
    animation.fillStyle = color;
    animation.closePath();
    animation.fill();
}
function drawWedge(centerX, centerY, r, start, color) {
    drawWedge2(centerX, centerY, r, start, start + 60, color);
}
// degree to radial
function d2r(degrees) {
    return degrees * (Math.PI / 180.0);
}

function avareageArray(input, sizeOutput){
    var output = [];

    for (var i = 0; i < input.length-2; i++){
        if (input[i] == 0 && input[i+1] == 0 && input[i+2] == 0){
            inputLength = i;
            break;
        }
    }
    inputLength = 600;

    if (inputLength < sizeOutput) {
    } else {
        // find how many sequence neet to be calculated
        var numbers = parseInt(inputLength / sizeOutput) +1;
        for (var i = 0; i < sizeOutput; i++){
            output.push(performCalc(input, inputLength, i * numbers, (i+1) * numbers));
        }
    }
    return output;
}

function performCalc(values, size, from, to) {
    var sum = 0;
    if (to > size )to = size;

    for (var i= from; i < to; i++) {
        sum += +values[i];
    }
    return sum / (to - from);
}

$.fn.shuffle = function() {

    var allElems = this.get(),
        getRandom = function(max) {
            return Math.floor(Math.random() * max);
        },
        shuffled = $.map(allElems, function(){
            var random = getRandom(allElems.length),
                randEl = $(allElems[random]).clone(true)[0];
            allElems.splice(random, 1);
            return randEl;
        });

    this.each(function(i){
        $(this).replaceWith($(shuffled[i]));
    });

    return $(shuffled);

};