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

window.addEventListener("input", function(e) {
	e.target.style.height = "auto";
	e.target.style.height = e.target.scrollHeight + 2 + "px";
	let a1 = document.querySelectorAll(".c3 textarea");
	let iFilled = 0;
	a1.forEach(function(v) {
		if (v.value != "") {
			iFilled += 1;
		}
	});
	if (iFilled == a1.length) {
		let e1 = document.createElement("textarea");
		id3.append(e1);
	}
	if (iFilled >= 2 && id2.value != "") {
		id4.style.visibility = "visible";
	} else {
		id4.style.visibility = "hidden";
	}
});

id4.addEventListener("click", function() {
	let a1 = document.querySelectorAll(".c3 textarea");
	let a2 = [];
	a2.push(id2.value);
	a1.forEach(function(v) {
		if (v.value != "") {
			a2.push(v.value);
		}
	});
	let j1 = JSON.stringify(a2);
	let xhr = new XMLHttpRequest();
	xhr.open('POST', '/web/quizzer/public/php/poll-submit.php', true);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			if (this.responseText != '') {
				let aResponse = JSON.parse(this.responseText);
				if (aResponse[0] == 0) {
					fSysMsg(aResponse[0], aResponse[1]);
				}
				if (aResponse[0] == 1) {
					id1.style.display = "none";
					id7.style.display = "block";
					id5.value = `quizzer.app/poll/${aResponse[1]}`;
				}
			}
		}
	}
	xhr.send(`j1=${j1}`);
});

id6.addEventListener("click", function() {
	navigator.clipboard.writeText(id5.value).then(function() {
		fSysMsg(1, "Link has been copied to clipboard.");
	}, function() {
		fSysMsg(0, "Unable to copy link to clipboard.");
	});
});