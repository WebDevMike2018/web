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

id1.addEventListener("submit", function(e) {
	e.preventDefault();
	let oForm = new FormData(id1);
	oForm.append("req", "1");
	let xhr = new XMLHttpRequest();
	xhr.open('POST', 'php/services.php', true);
	xhr.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			if (this.responseText != '') {
				let aResponse = JSON.parse(this.responseText);
				if (aResponse[0] == 0) {
					fSysMsg(aResponse[0], aResponse[1]);
				}
				if (aResponse[0] == 1) {
					fSysMsg(1, "Thank you for your submission!");
					id1.reset();
				}
			}
		}
	}
	xhr.send(oForm);
});