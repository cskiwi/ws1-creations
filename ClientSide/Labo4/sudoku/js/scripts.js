/*
 * Sudoku script
 *
 * @author Rogier van der Linde <rogier.vanderlinde@kahosl.be>
 * @author Bram(us) Van Damme <bramus.vandamme@kahosl.be>
 */

// object shortcuts
var table;
var rows;
var allCells;

// commits value
var commitValue = function(cell) {

	// set cell value
	var newVal = parseInt(cell.innerHTML, 10);
	if (isNaN(newVal)) newVal = '';
	if (!(newVal > 0 && newVal < 10) && newVal !== '') newVal = cell.restoreVal;
	cell.innerHTML = newVal;
	cell.restoreVal = newVal;

	// check the board
	var isValid = true;

	// check horizontal row
	var row = rows[cell.rownr];
	var cells = row.getElementsByTagName('td');
	for (var i = 0; i < cells.length; i++) {
		// skip current cell
		if (i == cell.colnr) continue;

		// check the rest
		if (cells[i].innerHTML !== '' & cells[i].innerHTML == cell.innerHTML) {
			isValid = false;
			break;
		}
	}

	// check vertical row
	var cells = [];
	for (var i = 0; i < rows.length; i++) {
		// skip current cell
		if (i == cell.rownr) continue;

		// check the rest
		var checkedCell = rows[i].getElementsByTagName('td')[cell.colnr];
		if (checkedCell.innerHTML !== '' & checkedCell.innerHTML == cell.innerHTML) {
			isValid = false;
			break;
		}
	}

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
		if (allCells[i].innerHTML === '') numEmptyCells++;
	}
	document.getElementById('numEmptyCells').innerHTML = numEmptyCells;

	// adjust number of errors
	var numErrors = table.querySelectorAll('td.invalid').length;
	document.getElementById('numErrors').innerHTML = numErrors;

	// done?
	if (numEmptyCells === 0 && numErrors === 0) {
		for (var i = 0; i < allCells.length; i++) {
			allCells[i].removeAttribute('contenteditable');
		}
		document.getElementById('numErrors').innerHTML = 'Gefeliciteerd!';
	}

};

window.addEventListener('load', function() {

	// object shortcuts
	table = document.getElementById('myTable');
	rows = table.getElementsByTagName('tr');
	allCells = table.getElementsByTagName('td');

	// iterate over all cells and attach properties and blur event listener
	for (var i = 0; i < rows.length; i++) {
		var cells = rows[i].getElementsByTagName('td');
		for (var j = 0; j < cells.length; j++) {
			// add some useful properties

            //JQuery hint: $(this).data('rownr', i)

			cells[j].rownr = i;
			cells[j].colnr = j;
			cells[j].restoreVal = cells[j].innerHTML;

			// add blur event listener to the cell itself, not the table as it'll never be triggered on the table
			cells[j].addEventListener('blur', function(e) {
				e.stopPropagation();
				commitValue(this);
			});
		}
	}

	// Keyboard events: attach these to the table as they'll bubble upwards from the cell to the table
	table.addEventListener('keydown', function(e) {
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

});

// EOF