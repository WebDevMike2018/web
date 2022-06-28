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

id1.addEventListener('submit', function(e) {
	e.preventDefault();
	let o_form = new FormData(id1);
	o_form.append("req", "1");
	fetch("php/login.php", {
	method: "POST",
	body: o_form })
	.then(response => response.json())
	.then(data => {
		if (data[0] == 0) {
			f_sys_msg(0, data[1]);
		}
		if (data[0] == 1) {
			if (id4.checked) {
				document.cookie = `password=${data[1]}; max-age=31536000; path=/; samesite=strict; secure`;
			}
			id1.reset();
			location = "manage";
		}
		if (data[0] == -1) {
			f_sys_msg(1, `You must wait ${data[1]} seconds before your next login attempt.`);
		}
		if (data[0] == -2) {
			f_sys_msg(1, `Incorrect password. You must wait ${data[1]} seconds before your next login attempt.`);
		}
	});
});

id2.addEventListener("click", function(e) {
	if (this.dataset.status == "hide") {
		this.dataset.status = "show";
		this.src = "media/hide.png";
		id3.type = "text";
		id3.focus();
	} else {
		this.dataset.status = "hide";
		this.src = "media/show.png";
		id3.type = "password";
		id3.focus();
	}
});