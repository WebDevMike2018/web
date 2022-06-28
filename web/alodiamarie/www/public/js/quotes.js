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

function f_quotes_get(e) {
	id3.style.display = "none";
	let s_year = e.target.innerHTML;
	fetch(`php/quotes.php?req=2&year=${s_year}`)
	.then(response => response.json())
	.then(data => {
		if (data[0] == 0) {
			f_sys_msg(0, data[1]);
		}
		if (data[0] == 1) {
			id2.innerHTML = "";
			data[1].forEach(function(v) {
				id2.innerHTML += `<tr><td>${v[0]}</td><td>${v[1]}</td><td>${v[2]}</td></tr>`;
			});
			document.querySelector(".a3 > div.active").classList.remove("active");
			e.target.classList.add("active");
			if (document.body.clientHeight > window.innerHeight * 2) {
				id3.style.display = "block";
			}
		}
	});
}

idh3.style.backgroundColor = "hsl(6, 100%, 94%)";

fetch("php/quotes.php?req=1")
.then(response => response.json())
.then(data => {
	if (data[0] == 0) {
		f_sys_msg(0, data[1]);
	}
	if (data[0] == 1) {
		data[1].forEach(function(v) {
			id1.innerHTML += `<div onclick="f_quotes_get(event)">${v}</div>`;
		});
		id1.firstElementChild.classList.add("active");
		id1.firstElementChild.click();
	}
});

id4.addEventListener("click", function(e) {
	window.scrollTo({
		top: 0,
		behavior: "smooth"
	});
});