/**
 * Created by Glenn on 12/3/13.
 */
for (var i = 0; i < $('#myTable tr').length; i++) {
    var cells = $('#myTable tr:eq('+ i +') td');
    for (var j = 0; j < cells.length; j++) {
        $('#myTable tr:eq('+ i +') td:eq('+j+')').data('rownr', i);
        $('#myTable tr:eq('+ i +') td:eq('+j+')').data('colnr', j);
        $('#myTable tr:eq('+ i +') td:eq('+j+')').data('restoreVal', $('#myTable tr:eq('+ i +') td').text());
    }
}

$('#myTable td').blur(function(){
    commitValue($(this));
});

$('#myTable').keydown(function(event){
    switch (event.keyCode){
        case 13:
            commitValue($(this));
            event.target.blur();
            break;
        case 27:
            event.target.text($(this).data('restoreVal'));
            event.target.blur();
            break;
    }
});

function commitValue(cell) {
    // check if valid number else restore and return
    if (isNaN(cell.text())){
        cell.text(cell.data('restoreVal'));
        return;
    }
    if (cell.text() < 0 || cell.text() > 9) {
        cell.text(cell.data('restoreVal'));
        return;
    }

    cell.data('restoreVal', cell.text());// save restore value
    cell.removeClass('invalid'); // reset valid state

    // determing block
    var blockrow, blockcol, rownr = cell.data('rownr')+1, colnr = cell.data('colnr')+1;
    while(rownr%3 != 0) rownr++;
    while(colnr%3 != 0) colnr++;
    blockrow = rownr/3-1;
    blockcol = colnr/3-1;

    // output number + block
    console.log('' + cell.data('rownr') + '(' + (blockrow) + ')' + ' x ' + cell.data('colnr') + '(' + (blockcol) + ')');

    // check if valid
    for (var i = 0; i < $('#myTable tr').length; i++){
        var cells = $('#myTable tr:eq('+i+') td')
        for (var j = 0; j < cells.length; j++){
            if (!(i == cell.data('rownr') && j == cell.data('colnr'))){

                // Check row
                if(cells.eq(j).data('rownr') == cell.data('rownr')){
                    if(cells.eq(j).text() == cell.text() && cell.text() != ''){
                        cell.addClass('invalid');
                        console.log('invalid row with: ' + (cells.eq(j).data('rownr')) + ' x ' + (cells.eq(j).data('colnr') ));
                    }
                }

                // skip check if already invalid
                if (cell.hasClass('invalid')) return;


                // check col
                if(cells.eq(j).data('colnr') == cell.data('colnr')){
                    if(cells.eq(j).text() == cell.text()  && cell.text() != ''){
                        cell.addClass('invalid');
                        console.log('invalid col with: ' + (cells.eq(j).data('rownr')) + ' x ' + (cells.eq(j).data('colnr')));
                    }
                }

                // skip check if already invalid
                if (cell.hasClass('invalid')) return;

                // check 3x3
                if(cells.eq(j).data('rownr') >= 3*blockrow && cells.eq(j).data('rownr') < 3*blockrow +3){
                    if(cells.eq(j).data('colnr') >= 3*blockcol && cells.eq(j).data('colnr') < 3*blockcol +3){
                        if(cells.eq(j).text() == cell.text() && cell.text() != ''){
                            cell.addClass('invalid');
                            console.log('invalid block with: ' + (cells.eq(j).data('rownr')) + ' x ' + (cells.eq(j).data('colnr')));
                        }
                    }
                }
            }
        }
    }

    // count empty cells
    var countRemaining = 0, countError = 0;
    for (var i = $('#myTable td').length - 1; i; i--) {
        if ($('#myTable td').eq(i).text() === '')
            countRemaining++;
        if ($('#myTable td').eq(i).className == 'invalid')
            countError++;
    }

    // check done
    if(countRemaining == 0 && countError == 0)
        $('#summary').text('Gefiliciteerd!');

    $('#numEmptyCells').text(countRemaining);
    $('#numErrors').text(countError);
}



