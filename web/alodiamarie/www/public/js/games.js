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

idh2.style.backgroundColor = "hsl(6, 100%, 94%)";

fetch("php/games.php?req=1")
.then(response => response.json())
.then(data => {
	if (data[0] == 0) {
		f_sys_msg(0, data[1]);
	}
	if (data[0] == 1) {
		data[1].forEach(function(v) {
			id1.innerHTML += `<tr><td>${v}</td></tr>`;
		});
		data[2].forEach(function(v) {
			id2.innerHTML += `<tr><td>${v}</td></tr>`;
		});
		let a1 = document.querySelectorAll("table");
		if (a1[0].clientWidth > a1[1].clientWidth) {
			a1[1].style.width = a1[0].clientWidth + "px";
		} else {
			a1[0].style.width = a1[1].clientWidth + "px";
		}
		if (document.body.clientHeight > window.innerHeight * 2) {
			id4.style.display = "block";
		}
	}
});

id3.addEventListener("click", function(e) {
	window.scrollTo({
		top: 0,
		behavior: "smooth"
	});
});