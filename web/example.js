let a_day = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
let a_month = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
let a_number = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];
let a_number_string = ["0", "1", "2", "3", "4", "5", "6", "7", "8", "9"];
let a_alphabet_uppercase = ["A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z"];
let a_alphabet_lowercase = ["a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z"];
let a_alpha_numeric = ["0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z", "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z"];
let a_alpha_numeric_safe = ["2", "3", "4", "5", "6", "7", "8", "9", "A", "B", "C", "D", "E", "F", "G", "H", "J", "K", "L", "M", "N", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z", "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z"];

//string interpolation
let s_var = "test";
console.log("this is a ${s_var}");

//assign same value to multiple variables
let x, y, z;
x = y = z = value;

//form Submit
element.addEventListener('submit', function(e) {
	e.preventDefault();
	let o_form = new FormData(idForm);
	o_form.append("req", "i");
});

// fetch get
fetch("php/test.php?req=1")
.then(response => response.json())
.then(data => {
	if (data[0] == 0) {
		f_sys_msg(0, data[1]);
	}
});

// fetch post
idForm.addEventListener('submit', function(e) {
	e.preventDefault();
	let o_form = new FormData(idForm);
	o_form.append("req", "1");
	fetch("php/test.php", {
	method: "POST",
	body: o_form })
	.then(response => response.json())
	.then(data => {
		if (data[0] == 0) {
			f_sys_msg(0, data[1]);
		}
	});
});

//partial Load
document.addEventListener('DOMContentLoaded', function() {});

//full Load
window.addEventListener('load', function() {});

//Self-Invoking Anonymous Function
(function() {}) ();

//XHR GET
let o_xhr = new XMLHttpRequest();
o_xhr.open('GET', 'php/link.php', true);
o_xhr.onreadystatechange = function () {
	if (this.readyState == 4 && this.status == 200) {
		if (this.responseText != '') {
			let a_response = JSON.parse(this.responseText);
			if (a_response[0] == 0) {
				f_sys_msg(a_response[0], a_response[1]);
			}
		}
	}
}
o_xhr.send();

//XHR POST
let o_xhr = new XMLHttpRequest();
o_xhr.open('POST', 'php/link.php', true);
o_xhr.onreadystatechange = function () {
	if (this.readyState == 4 && this.status == 200) {
		if (this.responseText != '') {
			let a_response = JSON.parse(this.responseText);
			if (a_response[0] == 0) {
				f_sys_msg(a_response[0], a_response[1]);
			}
			if (a_response[0] == 1) {
				//
			}
		}
	}
}
o_xhr.send(oForm);

//Shuffle Array
function f_shuffle_array(a) {
	for (let i = a.length - 1; i > 0; i--) {
		let x = Math.floor(Math.random() * (i + 1));
		let x1 = a[i];
		a[i] = a[x];
		a[x] = x1;
	}
}

//COOKIE
document.cookie = "key=value; max-age=31536000; path=/; samesite=strict; secure";

//Shift array values to the right
function f_shift_array_right(a) {
	let last_element = a.pop();
	a.unshift(last_element);
}

//Shift array values to the left
function f_shift_array_left(a) {
	let first_element = a.shift();
	a.push(first_element);
}

//get random integer between min max inclusive
function f_random_in(i_min, i_max) {
	return Math.floor(Math.random() * (i_max - i_min + 1)) + i_min;
}

//get query string from url
let s_query = window.location.search;  //"page=3&color=blue"
let o_usp = new URLSearchParams(s_query);
o_usp.get("page"); //"3"
