/**
 * Created by Glenn on 12/9/13.
 */
// 1 css
$('#btnCss1a').click(function() {
    $('p#txtCss1').addClass('error');
});

$( "#btnCss1b" ).click(function() {
    $("p#txtCss1").removeClass('error');
});

$( "#btnCss1c" ).click(function() {
    $("p#txtCss1").css('color', 'blue');
});

$( "#btnCss1d" ).click(function() {
    $("p#txtCss1")
        .css('color', 'green')
        .css('font-style', 'italic');
});

$( "#btnCss1e" ).click(function() {
    alert($("p#txtCss1").width());
});

$( "#btnCss1f" ).click(function() {
    $("p#txtCss1").width(600 + 'px');
});

$( "#btnCss1g" ).click(function() {
    $("p#txtCss1").text('blablablabla');
});


//2 sel

$( "#btnSel1a" ).click(function() {
    alert($("#targetSel1 a").length);
});

$( "#btnSel1b" ).click(function() {
    alert($("#targetSel1 a").first().text());
});

$( "#btnSel1c" ).click(function() {
    $("#targetSel1 a:even").css('background-color', 'grey');
});

$( "#btnSel1d" ).click(function() {
    $("#targetSel1 a.removeMe").parent().remove();
});

$( "#btnSel1e" ).click(function() {
    $("#targetSel1 a:eq(2)").css('font-weight','bold');
});

$( "#btnSel1f" ).click(function() {
    $("#targetSel1 a:contains('link7')").css('font-style', 'italic');
});

$( "#btnSel1g" ).click(function() {
    alert($("#targetSel1 a[title^='tip van de dag']:eq(1)").text());
});

// evets

$("#btnEvents1a").mouseover(function(){
    alert('ok');
});
var event1 = function(e){
    e.preventDefault();
    alert('nope');
};

$("#targetEvents1 a:first").on('click', event1);

$("#btnEvents2a").click(function(){
    $("#targetEvents1 a:first").off('click',event1);
});

$("#targetEvents2 a").click(function(e){
    alert($(this).parent().index());
})

$("#tarEvents1").one('focus', function(){
    $(this).val('');
});

$("#tarEvents1").on('keydown', function(event) {
    if (event.which == 83 && event.ctrlKey){
        $("#msgEvents1").append($('#tarEvents1').text());
        event.preventDefault();
        event.stopPropagation();
    }
});

// animate

// zie api.jquery

//toggle()
$('#btnAnim0').click(function(){
    $('#txtAnim0').toggle();
});
$('#btnAnim1').click(function(){
    $('#txtAnim1').fadeOut('slow');
});
$('#btnAnim2a').click(function(){
    $('#txtAnim2').slideUp(1000);
});
$('#btnAnim2b').click(function(){
    $('#txtAnim2').slideDown(1000);
});
$('#btnAnim3').click(function(){
    $('#txtAnim3').slideUp(1000).slideDown(1000);
});
