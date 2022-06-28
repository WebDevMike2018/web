function sortTable1(n) {
	var table, rows, switching, i, x, y, shouldSwitch, dir, switchCount = 0;
	table = document.getElementById('table1');
	switching = true;
	dir = 'asc';
	while (switching) {
		switching = false;
		rows = table.rows;
		for (i = 1; i < (rows.length - 1); i++) {
			shouldSwitch = false;
			x = rows[i].getElementsByTagName('TD')[n];
			y = rows[i + 1].getElementsByTagName('TD')[n];
			if (dir == 'asc') {
				if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
					shouldSwitch = true;
					break;
				}
			} else if (dir == 'desc') {
				if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
					shouldSwitch = true;
					break;
				}
			}
		}
		if (shouldSwitch) {
			rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
			switching = true;
			switchCount ++;
		} else {
			if (switchCount == 0 && dir == 'asc') {
				dir = 'desc';
				switching = true;
			}
		}
	}
}
function sortTable2(n) {
	var table, rows, switching, i, x, y, shouldSwitch, dir, switchCount = 0;
	table = document.getElementById('table2');
	switching = true;
	dir = 'asc';
	while (switching) {
		switching = false;
		rows = table.rows;
		for (i = 1; i < (rows.length - 1); i++) {
			shouldSwitch = false;
			x = rows[i].getElementsByTagName('TD')[n];
			y = rows[i + 1].getElementsByTagName('TD')[n];
			if (dir == 'asc') {
				if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
					shouldSwitch = true;
					break;
				}
			} else if (dir == 'desc') {
				if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
					shouldSwitch = true;
					break;
				}
			}
		}
		if (shouldSwitch) {
			rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
			switching = true;
			switchCount ++;
		} else {
			if (switchCount == 0 && dir == 'asc') {
				dir = 'desc';
				switching = true;
			}
		}
	}
}
sortTable1(0);
sortTable2(0);