
var fTimer = setInterval(function() {
	let iMinutes = Math.floor((iWaitTime % (60 * 60)) / 60);
	let iSeconds = Math.floor(iWaitTime % 60);
	if (iMinutes > 0) {
		id1.innerHTML = "You must wait " + iMinutes + "m " + iSeconds + "s before attempting to login.";
	} else {
		id1.innerHTML = "You must wait " + iSeconds + "s before attempting to login.";
	}
	iWaitTime -= 1;
	if (iWaitTime < 0) {
		clearInterval(fTimer);
		id1.innerHTML = "";
	}
}, 1000);