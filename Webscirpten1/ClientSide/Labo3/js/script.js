/**
 * Created by Glenn on 12/3/13.
 */

var table;
var rows;
var allCells;

window.addEventListener('load', function() {
    table = document.getElementById('myTable');
    rows = table.getElementsByTagName('tr');
    allCells = table.getElementsByTagName('td');

    for (var i = 0; i < rows.length; i++){
        var cells = rows[i].getElementsByTagName('td');
        for (var j = 0; j < cells.length; j++){
            cells[j].rownr = i;
            cells[j].colnr = j;
            cells[j].restoreVal = cells[j].innerHTML;
            cells[j].addEventListener('blur', function(event){
                commitValue(event.target);
            });
        }
    }

    table.addEventListener('keydown', function(event){
        switch (event.keyCode){
            case 13:
                commitValue(event.target);
                event.target.blur();
                break;
            case 27:
                event.target.innerHTML = event.target.restoreVal;
                event.target.blur();
                break;
        }
    });
});

function commitValue(cell) {
    // check if valid number else restore and return
    if (isNaN(cell.innerHTML)){
        cell.innerHTML = cell.restoreVal
        return;
    }
    if (cell.innerHTML < 0 || cell.innerHTML > 9) {
        cell.innerHTML = cell.restoreVal;
        return;
    }

    cell.restoreVal = cell.innerHTML; // save restore value
    cell.className = ''; // reset valid state

    // determing block
    var blockrow, blockcol, rownr = cell.rownr+1, colnr = cell.colnr+1;
    while(rownr%3 != 0) rownr++;
    while(colnr%3 != 0) colnr++;
    blockrow = rownr/3-1;
    blockcol = colnr/3-1;

    // output number + block
    console.log('' + cell.rownr + '(' + (blockrow) + ')' + ' x ' + cell.colnr + '(' + (blockcol) + ')');

    // check if valid
    for (var i = 0; i < rows.length; i++){
        var cells = rows[i].getElementsByTagName('td');
        for (var j = 0; j < cells.length; j++){
            // Check row
            if(cells[j].rownr == cell.rownr){
                if(cells[j].innerHTML == cell.innerHTML && cells[j] != cell && cell.innerHTML != ''){
                    cell.className = 'invalid';
                    console.log('invalid with: ' + (cells[j].rownr) + ' x ' + (cells[j].colnr ));
                }
            }

            // skip check if already invalid
            if (cell.className == 'invalid') return;

            // check col
            if(cells[j].colnr == cell.colnr){
                if(cells[j].innerHTML == cell.innerHTML && cells[j] != cell && cell.innerHTML != ''){
                    cell.className = 'invalid';
                    console.log('invalid with: ' + (cells[j].rownr) + ' x ' + (cells[j].colnr));
                }
            }

            // skip check if already invalid
            if (cell.className == 'invalid') return;

            // check 3x3
            if(cells[j].rownr >= 3*blockrow && cells[j].rownr < 3*blockrow +3){
                if(cells[j].colnr >= 3*blockcol && cells[j].colnr < 3*blockcol +3){
                    if(cells[j].innerHTML == cell.innerHTML && cells[j] != cell && cell.innerHTML != ''){
                        cell.className = 'invalid';
                        console.log('invalid with: ' + (cells[j].rownr) + ' x ' + (cells[j].colnr));
                    }
                }
            }

        }
    }

    // count empty cells
    var countRemaining = 0, countError = 0;
    for (var i = allCells.length - 1; i; i--) {
        if (allCells[i].innerHTML === '')
            countRemaining++;
        if (allCells[i].className == 'invalid')
            countError++;
    }

    // check done
    if(countRemaining == 0 && countError == 0)
        document.getElementById('summary').innerHTML = 'Gefiliciteerd!';

    document.getElementById('numEmptyCells').innerHTML = '' + countRemaining;
    document.getElementById('numErrors').innerHTML = '' + countError;
}



