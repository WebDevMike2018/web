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

(function() {
	let xhr = new XMLHttpRequest();
	xhr.open('GET', 'php/footer-get.php?req=link', true);
	xhr.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			if (this.responseText != '') {
				let aResponse = JSON.parse(this.responseText);
				if (aResponse[0] == 1) {
					idf6.href = `artist?index=${aResponse[1][0]}`;
					idf7.href = `artist?index=${aResponse[1][1]}`;
					idf8.href = `artist?index=${aResponse[1][0]}`;
					idf9.href = `artist?index=${aResponse[1][1]}`;
				}
			}
		}
	}
	xhr.send();
}) ();

idf2.addEventListener("input", function() {
	idf3.value = this.value;
});

idf3.addEventListener("input", function() {
	idf2.value = this.value;
});

[idf4, idf5].forEach(function(v) {
	v.addEventListener("submit", function(e) {
		e.preventDefault();
		let oForm = new FormData(v);
		let xhr = new XMLHttpRequest();
		xhr.open('POST', 'php/footer-subscribe.php', true);
		xhr.onreadystatechange = function () {
			if (this.readyState == 4 && this.status == 200) {
				if (this.responseText != '') {
					let aResponse = JSON.parse(this.responseText);
					if (aResponse[0] == 0) {
						fSysMsg(0, aResponse[1]);
					}
					if (aResponse[0] == 1) {
						fSysMsg(1, "Thank you for subscribing!");
						[idf4, idf5].forEach(function(v1) {
							v1.reset();
						})
					}
				}
			}
		}
		xhr.send(oForm);
	});
});

(function() {
	let xhr = new XMLHttpRequest();
	xhr.open('GET', 'php/visitor-counter.php', true);
	xhr.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			if (this.responseText != '') {
				let aResponse = JSON.parse(this.responseText);
				if (aResponse[0] == 1) {
					idf1.innerText = aResponse[1];
					idf10.innerText = aResponse[1];
				}
			}
		}
	}
	xhr.send();
}) ();

// idf9