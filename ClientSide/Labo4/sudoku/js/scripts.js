/*
 * Sudoku script
 *
 * @author Rogier van der Linde <rogier.vanderlinde@kahosl.be>
 * @author Bram(us) Van Damme <bramus.vandamme@kahosl.be>
 */


/**
 *
 *
 *
 * SCIPT IS NOT USED, Check other script!!!
 *
 * heb mijn eigen script gebruikt van labo 3
 * omdat ik daar de werking kende, en de block detectie zat er in
 *
 *
 */

// object shortcuts
var table;
var rows;
var allCells;

// commits value
var commitValue = function(cell) {
    // set cell value
    var newVal = parseInt(cell.text(), 10);
    if (isNaN(newVal)) newVal = '';
    if (!(newVal > 0 && newVal < 10) && newVal !== '') newVal = cell.data('restoreVal');
    cell.text(newVal);
    cell.data('restoreVal', newVal);

    // check the board
    var isValid = true;

    // check horizontal row
    cells = $('#myTable tr:eq('+cell.data('rownr') +') td');
    for (var i = 0; i < cells.length; i++) {
        // skip current cell.
        if (cells.eq(i) == cell) continue;
        console.log('horz '+ i+ ': ' +  cells.eq(i).text());


        // check the rest
        if (cells.eq(i).text() !== '' & cells.eq(i).text() == cell.text()) {
            isValid = false;
            break;
        }
    }
    // check vertical
    cells = $('#myTable tr td:eq('+cell.data('colnr') +')');
    for (var i = 0; i < cells.length; i++) {
        // skip current cell
        if (cells.eq(i) == cell) continue;
        console.log('vert '+ i+ ': ' +  cells.eq(i).text());

        // check the rest
        if (cells.eq(i).text() !== '' & cells.eq(i).text() == cell.text()) {
            isValid = false;
            break;
        }
    }

    console.log(isValid);

    // TODO: check same square
    var startrow = Math.floor(cell.rownr / 3);
    var startcol = Math.floor(cell.colnr / 3);
    var cells = [];
    for (var i = 0; i < rows.length; i++) {
        cells.push(rows[i].getElementsByTagName('td')[cell.colnr]);
    }


    // if invalid, change css
    cell.className = isValid ? '' : 'invalid';

    // adjust number of empty cells
    var numEmptyCells = 0;
    for (var i = 0; i < allCells.length; i++) {
        if (allcells.eq(i).innerHTML === '') numEmptyCells++;
    }
    $('#numEmptyCells').innerHTML = numEmptyCells;

    // adjust number of errors
    var numErrors = table.querySelectorAll('td.invalid').length;
    $('#numErrors').innerHTML = numErrors;

    // done?
    if (numEmptyCells === 0 && numErrors === 0) {
        for (var i = 0; i < allCells.length; i++) {
            allcells.eq(i).removeAttribute('contenteditable');
        }
        $('#numErrors').text('Gefeliciteerd!');
    }
};

$('#myTable tr td').blur(function(e){
    e.stopPropagation();
    commitValue($(this));
});

// iterate over all cells and attach properties and blur event listener
for (var i = 0; i < $('#myTable tr').length; i++) {
    var cells = $('#myTable tr:eq('+ i +') td');
    for (var j = 0; j < cells.length; j++) {
        $('#myTable tr:eq('+ i +') td:eq('+j+')').data('rownr', i);
        $('#myTable tr:eq('+ i +') td:eq('+j+')').data('colnr', j);
        $('#myTable tr:eq('+ i +') td:eq('+j+')').data('restoreVal', $('#myTable tr:eq('+ i +') td').text());
    }
}

// Keyboard events: attach these to the table as they'll bubble upwards from the cell to the table
$('#myTable').keydown(function(e) {
    // cell edited
    var cell = e.target;

    // enter key
    if (e.keyCode == 13) {
        cell.blur();
    }

    // escape key
    if (e.keyCode == 27) {
        cell.innerHTML = cell.restoreVal;
        cell.blur();
    }

    // make sure no other things get escaped
    e.stopPropagation();
});


// EOF