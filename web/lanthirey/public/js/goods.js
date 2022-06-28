let aImage = [[0, "media/goods/coming-soon.png"], [0, "media/goods/coming-soon.png"], [0, "media/goods/coming-soon.png"]];
let aImageContainer = document.querySelectorAll(".m27");
let aImageContainer1 = document.querySelectorAll(".d25");

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

function fCarousel(i1) {
	if (i1 == -1) {
		fShiftArrayRight(aImage);
	}
	if (i1 == 1) {
		fShiftArrayLeft(aImage);
	}
	for (let i = 0; i < aImageContainer.length; i++) {
		aImageContainer[i].src = aImage[i][1];
	}
	for (let i = 0; i < aImageContainer1.length; i++) {
		aImageContainer1[i].src = aImage[i][1];
	}
	if (aImage[1][0] != 0) {
		id3.href = `permalink?index=${aImage[1][0]}`;
		id6.href = `permalink?index=${aImage[1][0]}`;
	} else {
		id3.removeAttribute("href");
		id6.removeAttribute("href");
	}
	if (aImage.length == 4) {
		let o_img1 = new Image();
		o_img1.src = aImage[3][1];
	}
	if (aImage.length > 4) {
		let o_img1 = new Image();
		let o_img2 = new Image();
		o_img1.src = aImage[3][1];
		o_img2.src = aImage[aImage.length - 1][1];
	}
}

function fShiftArrayLeft(a) {
	let firstElement = a.shift();
	a.push(firstElement);
}

function fShiftArrayRight(a) {
	let lastElement = a.pop();
	a.unshift(lastElement);
}

(function() {
	let o_xhr = new XMLHttpRequest();
	o_xhr.open('GET', 'php/goods.php?req=1', true);
	o_xhr.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			if (this.responseText != '') {
				let a_response = JSON.parse(this.responseText);
				if (a_response[0] == 1) {
					aImage = a_response[1];
					if (aImage.length < 2) {
						aImage[1] = aImage[0];
						aImage[0] = [0, "media/goods/coming-soon.png"];
						aImage[2] = [0, "media/goods/coming-soon.png"];
					}
					if (aImage.length < 3) {
						aImage[2] = [0, "media/goods/coming-soon.png"];
					}
				}
				fCarousel(0);
			}
		}
	}
	o_xhr.send();
}) ();

id1.addEventListener("click", function(e) { fCarousel(-1); });

id2.addEventListener("click", function(e) { fCarousel(1); });

id4.addEventListener("click", function(e) { fCarousel(-1); });

id5.addEventListener("click", function(e) { fCarousel(1); });