{
	let xhr = new XMLHttpRequest();
	xhr.onreadystatechange=function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById('h1').href = this.responseText;
		}
	};
	xhr.open("GET", "php/random-pop.php", true);
	xhr.send();
}