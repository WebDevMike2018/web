function fDisplayVotes() {
	let a1 = document.querySelectorAll(".c3 > div");
	let iTotalVotes = 0;
	a1.forEach(function(v) {
		iTotalVotes += parseInt(v.dataset.votes);
	});
	if (iTotalVotes == 0) {
		iTotalVotes = 1;
	}
	/*
	a1 = Array.from(a1);
	a1.sort(function(a, b) {
		return parseInt(b.dataset.key) - parseInt(a.dataset.key);
	});
	*/
	id2.innerHTML = "";
	a1.forEach(function(v) {
		let iVotePercent = Math.round(parseInt(v.dataset.votes) / iTotalVotes * 100);
		v.classList.replace("c4", "c5");
		id2.append(v);
		let e1 = document.createElement("div");
		//e1.classList.add("c6");
		if (v.dataset.vote) {
			e1.classList.add("c8");
		} else {
			e1.classList.add("c7");
		}
		e1.style.width = iVotePercent + "%";
		if (iVotePercent > 0) {
			e1.style.height = "34px";
		} else {
			e1.style.height = "0px";
		}
		id2.append(e1);
		let e2 = document.createElement("div");
		e2.style.padding = "2px 0";
		e2.innerText = `${v.dataset.votes} votes (${iVotePercent}%)`;
		id2.append(e2);
	});
}

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
	let sCode = document.cookie.split("; ").find(row => row.startsWith("code=")).split("=")[1];
	let xhr = new XMLHttpRequest();
	xhr.open('GET', `/web/quizzer/public/php/poll-get.php?code=${sCode}`, true);
	xhr.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			if (this.responseText != '') {
				let aResponse = JSON.parse(this.responseText);
				if (aResponse[0] == 0) {
					fSysMsg(0, aResponse[1]);
				}
				if (aResponse[0] == 1) {
					id1.innerText = aResponse[1][0];
					for (let i = 1; i < aResponse[1].length; i++) {
						let e1 = document.createElement("div");
						e1.classList.add("c4");
						e1.dataset.key = i;
						e1.dataset.votes = aResponse[1][i][1];
						e1.innerText = aResponse[1][i][0];
						e1.addEventListener("click", function(e) {
							let s1 = e.target.dataset.key;
							let s2 = e.target.dataset.votes;
							let i1 = parseInt(s2);
							e.target.dataset.votes = i1 + 1;
							let xhr = new XMLHttpRequest();
							xhr.open('GET', `/web/quizzer/public/php/poll-vote.php?code=${sCode}&key=${s1}`, true);
							xhr.onreadystatechange = function () {
								if (this.readyState == 4 && this.status == 200) {
									if (this.responseText != '') {
										let aResponse = JSON.parse(this.responseText);
										if (aResponse[0] == 0) {
											fSysMsg(aResponse[0], aResponse[1]);
										}
										if (aResponse[0] == 1) {
											e.target.dataset.vote = "1";
											fDisplayVotes();
										}
									}
								}
							}
							xhr.send();
						});
						id2.append(e1);
					}
				}
				if (aResponse[0] == 2) {
					id1.innerText = aResponse[2][0];
					for (let i = 1; i < aResponse[2].length; i++) {
						let e1 = document.createElement("div");
						e1.classList.add("c4");
						e1.dataset.key = i;
						e1.dataset.votes = aResponse[2][i][1];
						if (i == aResponse[1]) {
							e1.dataset.vote = "1";
						}
						e1.innerText = aResponse[2][i][0];
						id2.append(e1);
					}
					fDisplayVotes();
				}
			}
		}
	}
	xhr.send();
}) ();