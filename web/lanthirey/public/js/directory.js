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
	xhr.open('GET', 'php/directory-get.php?req=1', true);
	xhr.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			if (this.responseText != '') {
				let aResponse = JSON.parse(this.responseText);
				if (aResponse[0] == 1) {
					for (let i = 0; i < aResponse[1].length; i++) {
						let o0 = document.createElement("a");
						o0.href = `artist.php?index=${aResponse[1][i]}`;
						o0.innerHTML = `<img src="media/directory/heart.png">${aResponse[2][i]} `;
						id1.append(o0);
						id2.innerHTML = id1.innerHTML;
					}
				}
			}
		}
	}
	xhr.send();
}) ();

(function() {
	let xhr = new XMLHttpRequest();
	xhr.open('GET', 'php/directory-get.php?req=2', true);
	xhr.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			if (this.responseText != '') {
				let aResponse = JSON.parse(this.responseText);
				if (aResponse[0] == 1) {
					for (let i = 0; i < aResponse[1].length; i++) {
						let o0 = document.createElement("a");
						o0.href = `tag.php?tag=${aResponse[1][i]}`;
						o0.innerText = `#${aResponse[1][i]} `;
						id3.append(o0);
						id4.innerHTML = id3.innerHTML;
					}
				}
			}
		}
	}
	xhr.send();
}) ();

//id4