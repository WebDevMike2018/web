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

idh1.style.backgroundColor = "hsl(6, 100%, 94%)";

fetch("php/index.php?req=1")
.then(response => response.json())
.then(data => {
	if (data[0] == 0) {
		f_sys_msg(0, data[1]);
	}
	if (data[0] == 1) {
		data[1].forEach(function(v) {
			id1.innerHTML += `<a href="${v[0]}" target="_blank">${v[1]}</a>`;
		});
	}
});