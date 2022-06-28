function f_sys_msg(i_type, s_msg) {
	if (i_type == -1) {
		id_sys_msg.style.visibility = 'hidden';
		id_sys_msg.style.backgroundColor = 'white';
	} else if (i_type == 0) {
		id_sys_msg.innerHTML = s_msg;
		id_sys_msg.style.color = 'white';
		id_sys_msg.style.visibility = 'visible';
		id_sys_msg.style.backgroundColor = 'hsl(0, 100%, 50%)';
		setTimeout(f_sys_msg, 6000, -1);
	} else {
		id_sys_msg.innerHTML = s_msg;
		id_sys_msg.style.color = 'black';
		id_sys_msg.style.visibility = 'visible';
		id_sys_msg.style.backgroundColor = 'hsl(120, 100%, 50%)';
		setTimeout(f_sys_msg, 6000, -1);
	}
}

function f_nav(i_dir) {
	let i_current = id5.options.selectedIndex;
	let i_length = id5.options.length;
	let i_total = i_current + i_dir;
	let i_page = i_total += 1;
	if (i_total >= 1 && i_total <= i_length) {
		window.location = `contacts?req=${o_usp.get("req")}&page=${i_page}`;
	}
}

let s_query = window.location.search;
let o_usp = new URLSearchParams(s_query);
if (o_usp.get("req") == "1") {
	id2.remove();
}

fetch(`php/contacts.php?req=${o_usp.get("req")}&page=${o_usp.get("page")}`)
.then(response => response.json())
.then(data => {
	if (data[0] == 0) {
		f_sys_msg(0, data[1]);
	}
	if (data[0] == 1) {
		data[1].forEach(v => {
			let e1 = document.createElement("tr");
			if (o_usp.get('req') == "1") {
				for (let i = 0; i < 6; i++) {
					let e2 = document.createElement("td");
					e2.innerText = v[i];
					e1.append(e2);
				}
			} else {
				for (let i = 0; i < 7; i++) {
					let e2 = document.createElement("td");
					e2.innerText = v[i];
					e1.append(e2);
				}
			}
			id1.append(e1);
		});
	}
});

fetch("php/contacts.php?req=3")
.then(response => response.json())
.then(data => {
	if (data[0] == 1) {
		let i_page = Math.ceil(parseInt(data[1]) / 100);
		for (let i = 1; i <= i_page; i++) {
			let e1 = document.createElement("option");
			e1.value = i;
			e1.innerText = i;
			id5.append(e1);
		}
		id5.value = o_usp.get("page");
	}
});

id5.addEventListener("change", function() {
	window.location = `contacts?req=${o_usp.get("req")}&page=${id5.value}`;
});

id6.addEventListener("click", function() { f_nav(-1); });

id7.addEventListener("click", function() { f_nav(1); });