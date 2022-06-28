let a1 = [];
let bStopSpin = false;
let e1;
let iAnnounceWinner, iSpinCount, iWinner;
iAnnounceWinner = iSpinCount = 0;
let sWinner;

function fShuffleArray(a) {
	for (let i = a.length - 1; i > 0; i--) {
		let x = Math.floor(Math.random() * (i + 1));
		let x1 = a[i];
		a[i] = a[x];
		a[x] = x1;
	}
}

function fSpin() {
	let sLastValue = e1[e1.length - 1].innerHTML;
	for (let i = e1.length - 2; i >= 0; i--) {
		if (i > 0) {
			e1[i + 1].innerHTML = e1[i].innerHTML;
		} else {
			e1[i + 1].innerHTML = e1[i].innerHTML;
			e1[i].innerHTML = sLastValue;
		}
	}
}

function fSpinStart() {
	if (bStopSpin) {
		iSpinCount = 0;
		fSpinStop();
		return;
	}
	if (iSpinCount < 60) {
		if (iSpinCount % 10 == 0) {
			fSpin();
		}
	} else if (iSpinCount < 120) {
		if (iSpinCount % 5 == 0) {
			fSpin();
		}
	} else {
		fSpin();
	}
	if (iSpinCount > 240) { bStopSpin = true; }
	iSpinCount++;
	requestAnimationFrame(fSpinStart);
}

function fSpinStop() {
	if (iSpinCount > 420) {
		bStopSpin = false;
		iSpinCount = 0;
		iWinner = Math.floor((e1.length - 1) / 2);
		//e1[iWinner].style.fontSize = "18px";
		//e1[iWinner].style.fontWeight = "700";
		for (let i = 0; i < e1.length; i++) {
			if (i == iWinner) {
				sWinner = e1[iWinner].innerHTML;
			} else {
				e1[i].style.opacity = "0";
			}
		}
		setTimeout(function() {
			id3.innerHTML = `<div class="c12">${sWinner}</div>`;
		}, 2000);
		return;
	}
	if (iSpinCount < 60) {
		if (iSpinCount % 2 == 0) {
			fSpin();
		}
	} else if (iSpinCount < 120) {
		if (iSpinCount % 4 == 0) {
			fSpin();
		}
	} else if (iSpinCount < 180) {
		if (iSpinCount % 6 == 0) {
			fSpin();
		}
	} else if (iSpinCount < 240) {
		if (iSpinCount % 8 == 0) {
			fSpin();
		}
	} else if (iSpinCount < 300) {
		if (iSpinCount % 10 == 0) {
			fSpin();
		}
	} else if (iSpinCount < 360) {
		if (iSpinCount % 20 == 0) {
			fSpin();
		}
	} else {
		if (iSpinCount % 30 == 0) {
			fSpin();
		}
	}
	iSpinCount++;
	requestAnimationFrame(fSpinStop);
}

id1.addEventListener("click", function() {
	let s = id2.value;
	let r = /,$/gm;
	s = s.replace(r, "");
	r = /\n/g;
	s = s.replace(r, ",");
	r = /, /g;
	s = s.replace(r, ",");
	a1 = s.split(",");
	if (a1.length > 1) {
		id4.style.display = "none";
		id5.style.display = "block";
		fShuffleArray(a1);
		for (let i = 0; i < a1.length; i++) {
			id3.innerHTML += `<div>${a1[i]}</div>`
		}
		e1 = document.querySelectorAll(".c9 > div");
	}
});

id6.addEventListener("click", function() {
	id7.style.display = "none";
	id3.style.filter = "none";
	fSpinStart();
});