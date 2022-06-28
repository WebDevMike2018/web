// j_date change on date click
// Variables
const a_days = ["Sundays", "Mondays", "Tuesdays", "Wednesdays", "Thursdays", "Fridays", "Saturdays"];
const a_months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
const a_schedule10 = document.querySelectorAll(".schedule10");
let a_date, a_time, i_a_date_index;

// Functions
function f_sys_msg(i_type, s_msg) {
	let o_sys_msg = document.getElementById('sys_msg');
	if (i_type == -1) {
		o_sys_msg.style.visibility = 'hidden';
		o_sys_msg.style.backgroundColor = 'white';
	} else if (i_type == 0) {
		o_sys_msg.innerHTML = s_msg;
		o_sys_msg.style.color = 'white';
		o_sys_msg.style.visibility = 'visible';
		o_sys_msg.style.backgroundColor = 'hsl(0, 100%, 50%)';
		setTimeout(f_sys_msg, 6000, -1);
	} else {
		o_sys_msg.innerHTML = s_msg;
		o_sys_msg.style.color = 'black';
		o_sys_msg.style.visibility = 'visible';
		o_sys_msg.style.backgroundColor = 'hsl(120, 100%, 50%)';
		setTimeout(f_sys_msg, 6000, -1);
	}
}

// Invoke
for (let i = 1; i < 17; i++) {
	let str = "const i" + i + " = document.getElementById('i" + i + "');";
	eval(str);
}

i1.addEventListener("click", function() {
	if (this.classList.contains("active")) {
		return;
	} else {
		i2.classList.remove("active");
		i1.classList.add("active");
		i7.style.display = "none";
		i3.style.display = "block";
	}
});

i2.addEventListener("click", function() {
	if (this.classList.contains("active")) {
		return;
	} else {
		i1.classList.remove("active");
		i2.classList.add("active");
		i3.style.display = "none";
		i7.style.display = "block";
		let xhr = new XMLHttpRequest();
		xhr.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				if (this.responseText != '') {
					let a_response = JSON.parse(this.responseText);
					a_date = a_response[0];
					let a_time_temp = a_response[1];
					a_time = [];
					for (let i = 0; i < a_time_temp.length; i++) {
						let x = JSON.parse(a_time_temp[i]);
						a_time.push(x);
					}
					let i_a_date = a_date.length;
					// get month
					let o_date = new Date();
					i8.innerHTML = a_months[o_date.getMonth()];
					// pad to first day of month
					let o_date1 = new Date(a_date[0]);
					o_date1.setDate(1);
					let i_day = o_date1.getDay();
					if (i_day > 0) {
						for (let i = 0; i < i_day; i++) {
							let e1 = document.createElement('div');
							e1.classList.add('schedule5')
							i9.append(e1);
						}
					}
					// pad to today
					i_day = o_date.getDate();
					for (let i = 1; i < i_day + 1; i++) {
						let e1 = document.createElement('div');
						e1.classList.add("schedule6");
						e1.innerHTML = i;
						i9.append(e1);
					}
					// add a_date[0]
					{
						let e1 = document.createElement('div');
						e1.id = "i100";
						e1.classList.add('schedule7');
						let o_date = new Date(a_date[0]);
						e1.innerHTML = o_date.getDate();
						e1.dataset.date = a_date[0];
						e1.classList.add('schedule14');
						i9.append(e1);
					}
					// add rest of a_date
					for (let i = 1; i < i_a_date; i++) {
						let o_date = new Date(a_date[i]);
						if (o_date.getDate() == 1) {
							// add new month
							let e1 = document.createElement('div');
							e1.classList.add("schedule8");
							e1.innerHTML = a_months[o_date.getMonth()];
							i9.append(e1);
							// pad to first day of month
							let i_day = o_date.getDay();
							if (i_day > 0) {
								for (let i = 0; i < i_day; i++) {
									let e1 = document.createElement('div');
									e1.classList.add('schedule5')
									i9.append(e1);
								}
							}
						}
						let e1 = document.createElement('div');
						e1.classList.add('schedule7');
						e1.innerHTML = o_date.getDate();
						e1.dataset.date = a_date[i];
						i9.append(e1);
					}
					// click listener for dates
					{
						let a_dates = document.querySelectorAll('.schedule7');
						a_dates.forEach(function(value){
							value.addEventListener('click', function() {
								if (this.classList.contains(".schedule14")) {
									return;
								} else {
									i11.checked = false;
									let s_date = this.dataset.date;
									i13.value = s_date;
									let o_date = new Date(s_date);
									i12.innerHTML = a_days[o_date.getDay()];
									let o_prev_date = document.querySelector(".schedule14");
									o_prev_date.classList.remove('schedule14');
									this.classList.add('schedule14');
									a_schedule10.forEach(function(value) {
										if (value.classList.contains("active")) {
											value.classList.remove("active");
										}
									});
									i_a_date_index = a_date.indexOf(s_date);
									a_time[i_a_date_index].forEach(function(value) {
										if (value.scheduled == 1) {
											let x = document.querySelector(".schedule10[data-time='" + value.time + "']");
											x.classList.add('active');
										}
									});
								}
							});
						});
					}
					i100.click();
				}
			}
		};
		xhr.open('GET', "php/manage-get-schedule.php", true);
		xhr.send();
	}
});

(function() {
	let a = document.querySelectorAll(".orders_nav > div");
	a.forEach(function(value) {
		value.addEventListener("click", function() {
			if (this.classList.contains("active")) {
				return;
			} else {
				let a1 = document.querySelectorAll(".orders_nav > div");
				a1.forEach(function(value) {
					value.classList.remove("active");
				});
				this.classList.add("active");
				i4.style.display = "none";
				i5.style.display = "none";
				i6.style.display = "none";
				switch (this) {
					case a1[0]:
						i4.style.display = "block";
						break;
					case a1[1]:
						i5.style.display = "block";
						break;
					case a1[2]:
						i6.style.display = "block";
				}
			}
		});
	});
})();

(function() {
	let a = document.querySelectorAll(".schedule10");
	a.forEach(function(value) {
		value.addEventListener('click', function() {
			if (this.classList.contains('active')) {
				this.classList.remove('active');
				let i_index = parseInt(this.dataset.time);
				a_time[i_a_date_index][i_index].scheduled = 0;
			} else {
				this.classList.add('active');
				let i_index = parseInt(this.dataset.time);
				a_time[i_a_date_index][i_index].scheduled = 1;
			}
		});
	});
})();

i11.addEventListener('click', function() {
	if (this.checked == true) {
		let o_date = new Date(i13.value);
		let i_day = o_date.getDay();
		i16.value = i_day;
		let a_dates = [];
		for (let i = i_a_date_index; i < a_date.length; i++) {
			let o_date1 = new Date(a_date[i]);
			let i_day1 = o_date1.getDay();
			if (i_day == i_day1) {
				a_dates.push(a_date[i]);
			}
		}
		i11.value = JSON.stringify(a_dates);
	}
});

i14.addEventListener('submit', function(e) {
	e.preventDefault();
	let o_form = new FormData(i14);
	o_form.set('j_time', JSON.stringify(a_time[i_a_date_index]));
	let xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			if (this.responseText != '') {
				let a_response = JSON.parse(this.responseText);
				f_sys_msg(a_response[0], a_response[1]);
			}
		}
	};
	xhr.open('POST', "php/manage-put-schedule.php", true);
	xhr.send(o_form);
});