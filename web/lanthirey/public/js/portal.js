function fSysMsg(iType, sMsg) {
	if (iType == -1) {
		idSysMsg.style.visibility = 'hidden';
		idSysMsg.style.backgroundColor = 'white';
	} else if (iType == 0) {
		idSysMsg.innerHTML = sMsg;
		idSysMsg.style.color = 'white';
		idSysMsg.style.visibility = 'visible';
		idSysMsg.style.backgroundColor = 'hsl(0, 100%, 50%)';
		setTimeout(fSysMsg, 6000, -1);
	} else {
		idSysMsg.innerHTML = sMsg;
		idSysMsg.style.color = 'black';
		idSysMsg.style.visibility = 'visible';
		idSysMsg.style.backgroundColor = 'hsl(120, 100%, 50%)';
		setTimeout(fSysMsg, 6000, -1);
	}
}

id1.addEventListener('submit', function(e) {
	e.preventDefault();
	let oFormData = new FormData(id1);
	oFormData.append("req", "1");
	let xhr = new XMLHttpRequest();
	xhr.open('POST', 'php/portal.php');
	xhr.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			id1.reset();
			document.cookie = "portal=true; max-age=31536000; path=/; samesite=strict; secure";
			window.location.replace("/");
		}
	}
	xhr.send(oFormData);
});

id2.checked = false;
id2.addEventListener("change", function(e) {
	if (id2.checked == true) {
		id3.style.visibility = "visible";
		id4.setAttribute("required", "");
	} else {
		id3.style.visibility = "hidden";
		id4.removeAttribute("required", "");
	}
});

id4.addEventListener("input", function(e) {
	id2.value = id4.value;
});