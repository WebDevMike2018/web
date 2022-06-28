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

function f_a13_click(e) {
	let s_text = this.dataset.text;
	let s_confirm = `Are you sure you want to delete ${s_text}`;
	if (confirm(s_confirm)) {
		let o_form = new FormData();
		o_form.append("req", "2");
		o_form.append("index", this.dataset.index);
		fetch("php/manage.php", {
		method: "POST",
		body: o_form })
		.then(response => response.json())
		.then(data => {
			if (data[0] == 0) {
				f_sys_msg(0, data[1]);
			}
			if (data[0] == 1) {
				f_sys_msg(1, `${s_text} has been deleted.`);
				this.parentElement.parentElement.remove();
			}
		});
	}
}

function f_a15_click(e) {
	let s_text = this.dataset.text;
	let s_confirm = `Are you sure you want to delete ${s_text}`;
	if (confirm(s_confirm)) {
		let o_form = new FormData();
		o_form.append("req", "4");
		o_form.append("table", this.dataset.table);
		o_form.append("index", this.dataset.index);
		fetch("php/manage.php", {
		method: "POST",
		body: o_form })
		.then(response => response.json())
		.then(data => {
			if (data[0] == 0) {
				f_sys_msg(0, data[1]);
			}
			if (data[0] == 1) {
				f_sys_msg(1, `${s_text} has been deleted.`);
				this.parentElement.parentElement.remove();
			}
		});
	}
}

fetch("php/manage.php?req=1")
.then(response => response.json())
.then(data => {
	if (data[0] == 0) {
		f_sys_msg(0, data[1]);
	}
	if (data[0] == 1) {
		data[1].forEach(function(v) {
			id4.innerHTML += `<tr><td><img class="a13" data-index="${v[0]}" data-text="${v[1]}" src="media/close-red.png"</td><td>${v[1]}</td></tr>`;
		});
		document.querySelectorAll(".a13").forEach(function(v) {
			v.addEventListener("click", f_a13_click);
		});
	}
});

fetch("php/manage.php?req=2")
.then(response => response.json())
.then(data => {
	if (data[0] == 0) {
		f_sys_msg(0, data[1]);
	}
	if (data[0] == 1) {
		data[1].forEach(function(v) {
			id8.innerHTML += `<tr><td><img class="a15" data-index="${v[0]}" data-text="${v[1]}" data-table="1" src="media/close-red.png"</td><td>${v[1]}</td></tr>`;
		});
		data[2].forEach(function(v) {
			id9.innerHTML += `<tr><td><img class="a15" data-index="${v[0]}" data-text="${v[1]}" data-table="2" src="media/close-red.png"</td><td>${v[1]}</td></tr>`;
		});
		document.querySelectorAll(".a15").forEach(function(v) {
			v.addEventListener("click", f_a15_click);
		});
	}
});

id1.addEventListener("click", function(e) {
	if (this.dataset.status == "closed") {
		this.dataset.status = "opened";
		this.src = "media/remove.png";
		id2.style.display = "block";
	} else {
		this.dataset.status = "closed";
		this.src = "media/add.png";
		id2.style.display = "none";
	}
});

id3.addEventListener('submit', function(e) {
	e.preventDefault();
	let o_form = new FormData(id3);
	o_form.append("req", "1");
	fetch("php/manage.php", {
	method: "POST",
	body: o_form })
	.then(response => response.json())
	.then(data => {
		if (data[0] == 0) {
			f_sys_msg(0, data[1]);
		}
		if (data[0] == 1) {
			id3.reset();
			f_sys_msg(1, "Link added.");
		}
	});
});

id5.addEventListener("click", function(e) {
	if (this.dataset.status == "closed") {
		this.dataset.status = "opened";
		this.src = "media/remove.png";
		id6.style.display = "block";
	} else {
		this.dataset.status = "closed";
		this.src = "media/add.png";
		id6.style.display = "none";
	}
});

id7.addEventListener('submit', function(e) {
	e.preventDefault();
	let o_form = new FormData(id7);
	o_form.append("req", "3");
	o_form.append("type", e.submitter.dataset.type);
	fetch("php/manage.php", {
	method: "POST",
	body: o_form })
	.then(response => response.json())
	.then(data => {
		if (data[0] == 0) {
			f_sys_msg(0, data[1]);
		}
		if (data[0] == 1) {
			id7.reset();
			f_sys_msg(1, "Game added.");
		}
	});
});

id10.addEventListener('submit', function(e) {
	e.preventDefault();
	let o_form = new FormData(id10);
	o_form.append("req", "5");
	fetch("php/manage.php", {
	method: "POST",
	body: o_form })
	.then(response => response.json())
	.then(data => {
		if (data[0] == 0) {
			f_sys_msg(0, data[1]);
		}
		if (data[0] == 1) {
			f_sys_msg(1, "Picture has been updated.");
			id10.reset();
		}
	});
});