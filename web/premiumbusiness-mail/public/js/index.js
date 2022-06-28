function f_a18_click(e) {
	if (confirm(`Are you sure you want to reset the password for ${this.dataset.email}?`)) {
		let o_form = new FormData();
		o_form.append("req", "2");
		o_form.append("email", this.dataset.email);
		fetch("php/index.php", {
		method: "POST",
		body: o_form })
		.then(response => response.json())
		.then(data => {
			if (data[0] == 0) {
				f_sys_msg(0, data[1]);
			}
			if (data[0] == 1) {
				id19.value = data[1];
				id16.showModal();
			}
		});
	}
}

function f_a19_click(e) {
	if (confirm(`Are you sure you want to delete ${this.dataset.email}?`)) {
		let o_form = new FormData();
		o_form.append("req", "4");
		o_form.append("email", this.dataset.email);
		fetch("php/index.php", {
		method: "POST",
		body: o_form })
		.then(response => response.json())
		.then(data => {
			if (data[0] == 0) {
				f_sys_msg(0, data[1]);
			}
			if (data[0] == 1) {
				document.querySelector(`.a15[data-email="${this.dataset.email}"]`).style.display = "none";
				f_sys_msg(1, `${this.dataset.email} has been deleted.`);
			}
		});
	}
}

function f_password_toggle(e) {
	if (this.dataset.status == "0") {
		this.dataset.status = "1";
		this.firstChild.src = "media/hide.png";
		this.previousElementSibling.type = "text";
	} else {
		this.dataset.status = "0";
		this.firstChild.src = "media/show.png";
		this.previousElementSibling.type = "password";
	}
}

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

fetch("php/index.php?req=1")
.then(response => response.json())
.then(data => {
	if (data[0] == 1) {
		id15.style.display = "block";
		data[1].forEach(function(v) {
			id21.innerHTML += `<div class="a15" data-email="${v}"><div class="a17">${v}</div><div class="a16"><button class="a18" data-email="${v}">RESET PASSWORD</button><button class="a19" data-email="${v}">DELETE</button></div></div>`;
		});
		document.querySelectorAll(".a18").forEach(function(v) {
			v.addEventListener("click", f_a18_click);
		});
		document.querySelectorAll(".a19").forEach(function(v) {
			v.addEventListener("click", f_a19_click);
		});
	}
	if (data[0] == 2) {
		id1.style.display = "block";
		id11.innerText = data[1];
	}
});

id2.addEventListener("submit", function(e) {
	e.preventDefault();
	if (id4.value !== id5.value) {
		f_sys_msg(0, "New passwords do not match.");
		return;
	}
	let o_form = new FormData(id2);
	o_form.append("req", "1");
	fetch("php/index.php", {
	method: "POST",
	body: o_form })
	.then(response => response.json())
	.then(data => {
		if (data[0] == 0) {
			f_sys_msg(0, data[1]);
		}
		if (data[0] == 1) {
			id2.reset();
			f_sys_msg(1, "Your password has been changed.");
		}
	});
});

id8.addEventListener("click", f_password_toggle);

id9.addEventListener("click", f_password_toggle);

id10.addEventListener("click", f_password_toggle);

id17.addEventListener("click", function(e) {
	id16.close();
});

id18.addEventListener("click", function(e) {
	navigator.clipboard.writeText(id19.value).then(function() {
		f_sys_msg(1, "The password has been copied to your clipboard.");
	}, function() {
		f_sys_msg(0, "Unable to copy password to clipboard.");
	});
});

id20.addEventListener('submit', function(e) {
	e.preventDefault();
	let o_form = new FormData(id20);
	o_form.append("req", "3");
	fetch("php/index.php", {
	method: "POST",
	body: o_form })
	.then(response => response.json())
	.then(data => {
		if (data[0] == 0) {
			f_sys_msg(0, data[1]);
		}
		if (data[0] == 1) {
			id29.innerText = data[1];
			id27.value = data[2];
			id23.showModal();
			id20.reset();
		}
	});
});

id28.addEventListener("click", function(e) {
	navigator.clipboard.writeText(id27.value).then(function() {
		f_sys_msg(1, "The password has been copied to your clipboard.");
	}, function() {
		f_sys_msg(0, "Unable to copy password to clipboard.");
	});
});

id30.addEventListener("click", function(e) {
	id23.close();
});