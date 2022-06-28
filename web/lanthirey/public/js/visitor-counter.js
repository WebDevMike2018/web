{
	// variables
	const visitorCounter = document.getElementById('visitorCounter');

	// functions


	// invoke
	(function() {
		let xhr = new XMLHttpRequest();
		xhr.onreadystatechange=function() {
		if (this.readyState == 4 && this.status == 200) {
			visitorCounter.innerHTML = this.responseText;
		}
		};
		xhr.open("GET", "php/visitor-counter.php", true);
		xhr.send();
	})();
}