var o_year = 'year2022';
var o_table = 'table2022';

function f_year_css(pre_tab, new_tab, pre_year, new_year) {
	document.getElementById(pre_tab).style.display = 'none';
	document.getElementById(new_tab).style.display = 'table';
	document.getElementById(pre_year).classList.remove('active');
	document.getElementById(new_year).classList.add('active');
}
/* 
function f_year(table) {
	if(table == 'table2021') {
		f_year_css(o_table, table, o_year, 'year2021');
		o_year = 'year2021';
		o_table = 'table2021';
	} else if(table == 'table2020') {
		f_year_css(o_table, table, o_year, 'year2020');
		o_year = 'year2020';
		o_table = 'table2020';
	} else {
		f_year_css(o_table, table, o_year, 'year2019');
		o_year = 'year2019';
		o_table = 'table2019';
	}
}
 */
function f_year(table) {
	f_year_css(o_table, table, o_year, table.replace("table", "year"));
	o_year = table.replace("table", "year");
	o_table = table;
}

function sortTable(n, table) {
	var table, rows, switching, i, x, y, shouldSwitch, dir, switchCount = 0;
	table = document.getElementById(table);
	switching = true;
	dir = 'desc';
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
			if (switchCount == 0 && dir == 'desc') {
				dir = 'asc';
				switching = true;
			}
		}
	}
}
function sortTableInt(n, table) {
	var table, rows, switching, i, x, y, shouldSwitch, dir, switchCount = 0;
	table = document.getElementById(table);
	switching = true;
	dir = 'desc';
	while (switching) {
		switching = false;
		rows = table.rows;
		for (i = 1; i < (rows.length - 1); i++) {
			shouldSwitch = false;
			x = rows[i].getElementsByTagName('TD')[n];
			y = rows[i + 1].getElementsByTagName('TD')[n];
			if (dir == 'asc') {
				if (parseInt(x.innerHTML) > parseInt(y.innerHTML)) {
					shouldSwitch = true;
					break;
				}
			} else if (dir == 'desc') {
				if (parseInt(x.innerHTML) < parseInt(y.innerHTML)) {
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
			if (switchCount == 0 && dir == 'desc') {
				dir = 'asc';
				switching = true;
			}
		}
	}
}