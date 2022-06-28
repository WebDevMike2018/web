// variables
const iLength = 9;	// odd integer representing visible pagination
const iHalf = Math.floor(iLength / 2);
const sContentId = 'id1';	// name of content id
const oContent = document.getElementById(sContentId);
const sPaginationId = 'id2';	// name of pagination id
const oPagination = document.getElementById(sPaginationId);
const sScrollId = 'scrollTop';	// name of scroll to element id
const sActive = 'active';	// name of active class
let bMax;
let sQuery = window.location.search;
let oURLparam = new URLSearchParams(sQuery);
const sTag = oURLparam.get('tag');
let iPage = oURLparam.get('page');
if (!iPage) { iPage = 1; }

// functions
function fGetContent(n) {
	let xhr = new XMLHttpRequest();
	xhr.onreadystatechange=function() {
		if (this.readyState == 4 && this.status == 200) {
			let data = JSON.parse(this.responseText);
			location.hash = sScrollId;
			oContent.innerHTML = data[1];
			history.pushState({}, "", "tag?tag=" + sTag + "&page=" + n);
			if (data[0] > 1) {
				fDrawPagination(n, n, data[0]);
			}
			let aIframe = document.querySelectorAll("iframe");
			aIframe.forEach(function(v) {
				v.setAttribute("width", "");
				v.style.width = "100%";
			});
			let a_upvote = document.querySelectorAll('.cl13');
			a_upvote.forEach(function(value) {
				let i_index = value.dataset.index;
				value.addEventListener('click', function() {
					let xhr = new XMLHttpRequest();
					xhr.onreadystatechange = function () {
						if(this.readyState == 4 && this.status == 200) {
							if(this.responseText == 'true') {
								let o_upvote = value.nextElementSibling;
								o_upvote.innerHTML = parseInt(o_upvote.innerHTML) + 1;
							}else if(this.responseText != '') {
								let a_response = JSON.parse(this.responseText);
								if (a_response[0] == 0) {
									f_sys_msg(0, a_response[1]);
								}
							}
						}
					};
					xhr.open("GET", "php/upvote.php?index=" + i_index, true);
					xhr.send();
				});
			});
		}
	};
	xhr.open("GET", "php/tag-pop.php?tag=" + sTag + "&page=" + n, true);
	xhr.send();
}

function fDrawPagination(n, iActive, iMax) {
	oPagination.innerHTML = '';
	if (n - iHalf <= 1) {
		bMax = false;
		for (let i = 1; i < iLength + 1; i++) {
			let oNewElement = document.createElement('div');
			oNewElement.innerHTML = i;
			oNewElement.addEventListener('click', function() {
				fGetContent(i);
			});
			if (i === iActive) {
				oNewElement.classList.add(sActive);
			}
			oPagination.appendChild(oNewElement);
			if (i === iMax) {
				bMax = true;
				break;
			}
		}
		if (!bMax) {
			fDrawForward(1 + iHalf, iActive, iMax);
		}
	} else if (n + iHalf >= iMax) {
		fDrawBackward(iMax - iHalf, iActive, iMax);
		for (let i = iMax - (iLength - 1); i < iMax + 1; i++) {
			let oNewElement = document.createElement('div');
			oNewElement.innerHTML = i;
			oNewElement.addEventListener('click', function() {
				fGetContent(i);
			});
			if (i === iActive) {
				oNewElement.classList.add(sActive);
			}
			oPagination.appendChild(oNewElement);
		}
	} else {
		fDrawBackward(n, iActive, iMax);
		for (let i = n - iHalf; i < n + iHalf + 1; i++) {
			let oNewElement = document.createElement('div');
			oNewElement.innerHTML = i;
			oNewElement.addEventListener('click', function() {
				fGetContent(i);
			});
			if (i === iActive) {
				oNewElement.classList.add(sActive);
			}
			oPagination.appendChild(oNewElement);
		}
		fDrawForward(n, iActive, iMax);
	}
}

function fDrawBackward (n, iActive, iMax) {
	let oNewElement = document.createElement('div');
	oNewElement.innerHTML = "&lt;&lt;";
	oNewElement.addEventListener('click', function() {
		fDrawPagination(1, iActive, iMax);
	});
	oPagination.appendChild(oNewElement);
	oNewElement = document.createElement('div');
	oNewElement.innerHTML = "&lt;";
	oNewElement.addEventListener('click', function() {
		fDrawPagination(n - iLength, iActive, iMax);
	});
	oPagination.appendChild(oNewElement);
}

function fDrawForward(n, iActive, iMax) {
	let oNewElement = document.createElement('div');
	oNewElement.innerHTML = "&gt;";
	oNewElement.addEventListener('click', function() {
		fDrawPagination(n + iLength, iActive, iMax);
	});
	oPagination.appendChild(oNewElement);
	oNewElement = document.createElement('div');
	oNewElement.innerHTML = "&gt;&gt;";
	oNewElement.addEventListener('click', function() {
		fDrawPagination(iMax, iActive, iMax);
	});
	oPagination.appendChild(oNewElement);
}

// invoke
(function() {
	let aTitle = document.getElementsByTagName('title');
	aTitle[0].innerHTML = 'Lanthirey #' + sTag;
})();

fGetContent(iPage);