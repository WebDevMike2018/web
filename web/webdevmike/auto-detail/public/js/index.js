// Variables
const a_months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
const a_schedule10 = document.querySelectorAll(".schedule10");
let a_date, a_schedule7, a_time, b_review, i_a_date_index;
b_review = 0;

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
for (let i = 1; i < 50; i++) {
	let str = "const i" + i + " = document.getElementById('i" + i + "');";
	eval(str);
}

i2.style.marginTop = i1.offsetHeight + "px";
window.addEventListener('resize', function() {
	i2.style.marginTop = i1.offsetHeight + "px";
});

i4.style.display = "block";

(function() {
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
				let o_date = new Date(a_date[0]);
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
				if (o_date.getDate() != 1) {
					// pad to today
					i_day = o_date.getDate();
					for (let i = 1; i < i_day; i++) {
						let e1 = document.createElement('div');
						e1.classList.add("schedule6");
						e1.innerHTML = i;
						i9.append(e1);
					}
				}
				// add a_date[0]
				{
					let e1 = document.createElement('div');
					e1.classList.add('schedule7');
					let o_date = new Date(a_date[0]);
					e1.innerHTML = o_date.getDate();
					e1.dataset.date = a_date[0];
					e1.dataset.index = 0;
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
					e1.dataset.index = i;
					i9.append(e1);
				}

				// disable dates without a schedule
				{
					a_schedule7 = document.querySelectorAll('.schedule7');
					for (let i = 0; i < a_time.length; i++) {
						let b_schedule = 0;
						for (let i1 = 0; i1 < a_time[i].length; i1++) {
							if (a_time[i][i1].scheduled == 1 && a_time[i][i1].reserved == 0) {
								b_schedule = 1;
								break;
							}
						}
						if (b_schedule == 0) {
							a_schedule7[i].classList.add('schedule6');
							a_schedule7[i].classList.remove('schedule7');
						}
					}
				}
				// click listener for dates
				{
					a_schedule7 = document.querySelectorAll('.schedule7');
					a_schedule7.forEach(function(value){
						value.addEventListener('click', function() {
							if (this.classList.contains(".schedule14")) {
								return;
							} else {
								i31.style.visibility = "visible";
								i11.value = this.dataset.date;
								let o_prev_date = document.querySelector(".schedule14");
								if (o_prev_date) { o_prev_date.classList.remove('schedule14'); }
								this.classList.add('schedule14');
								a_schedule10.forEach(function(value) {
									value.style.display = "none";
								});
								a_time[parseInt(this.dataset.index)].forEach(function(value, key) {
									if (value.scheduled == 1 && value.reserved == 0) {
										a_schedule10[key].style.display = "block";
									}
								});
								let o_date = new Date(this.dataset.date);
								let s_month = a_months[o_date.getMonth()];
								let i_date = o_date.getDate();
								i16.innerHTML = s_month + " " + i_date;
							}
						});
					});
				}

				// set active date
				{
					let x = document.querySelector('.schedule7');
					x.click();
				}
			}
		}
	};
	xhr.open('GET', "php/manage-get-schedule.php", true);
	xhr.send();
})();

// click listener for time
(function() {
	let a = document.querySelectorAll(".schedule10");
	a.forEach(function(value) {
		value.addEventListener('click', function() {
			let o_prev_time = document.querySelector('.schedule15');
			if (o_prev_time) { o_prev_time.classList.remove('schedule15'); }
			this.classList.add('schedule15');
			i12.value = this.dataset.time;
			i17.innerHTML = this.innerHTML;
			i43.value = this.innerHTML;
			i7.style.display = "none";
			if (b_review) {
				i14.style.display = "block";
			} else {
				i13.style.display = "block";
			}
		});
	});
})();

i3.addEventListener('submit', function(e) {
	e.preventDefault();
	if (i3.checkValidity() == false) { return; }
	i13.style.display = "none";
	i14.style.display = "block";
	b_review = 1;
});

i5.addEventListener('click', function() {
	i10.value = "Standard";
	i15.innerHTML = "Standard<br>$199";
	i4.style.display = "none";
	if (b_review) {
		i14.style.display = "block";
	} else {
		i7.style.display = "block";
	}
});

i6.addEventListener('click', function() {
	i10.value = "Deluxe";
	i15.innerHTML = "Deluxe<br>$299";
	i4.style.display = "none";
	if (b_review) {
		i14.style.display = "block";
	} else {
		i7.style.display = "block";
	}
});

i24.addEventListener('change', function() {
	i18.innerHTML = this.value;
});

i25.addEventListener('change', function() {
	i19.innerHTML = this.value;
});

i26.addEventListener('change', function() {
	i20.innerHTML = this.value;
});

i27.addEventListener('change', function() {
	i21.innerHTML = this.value;
});

i28.addEventListener('change', function() {
	i22.innerHTML = this.value;
});

i29.addEventListener('change', function() {
	i33.innerHTML = this.value;
});

i30.addEventListener('change', function() {
	i23.innerHTML = this.value;
});

i34.addEventListener('click', function() {
	i14.style.display = "none";
	i4.style.display = "block";
});

i35.addEventListener('click', function() {
	i14.style.display = "none";
	i7.style.display = "block";
});

i36.addEventListener('click', function() {
	i14.style.display = "none";
	i7.style.display = "block";
});

i37.addEventListener('click', function() {
	i14.style.display = "none";
	i13.style.display = "block";
});

i38.addEventListener('click', function() {
	i14.style.display = "none";
	i13.style.display = "block";
});

i39.addEventListener('click', function() {
	i14.style.display = "none";
	i13.style.display = "block";
});

i40.addEventListener('click', function() {
	i14.style.display = "none";
	i13.style.display = "block";
});

i41.addEventListener('click', function() {
	i14.style.display = "none";
	i13.style.display = "block";
});

i42.addEventListener('click', function() {
	i14.style.display = "none";
	i13.style.display = "block";
});

i45.addEventListener('change', function() {
	i46.innerHTML = this.value;
});

i47.addEventListener('click', function() {
	i14.style.display = "none";
	i13.style.display = "block";
});

i48.addEventListener('click', function() {
	let o_form = new FormData(i3);
	let xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			if (this.responseText != '') {
				let a_response = JSON.parse(this.responseText);
				if (a_response[0] == 0) {
					f_sys_msg(a_response[0], a_response[1]);
				} else {
					i14.style.display = "none";
					i44.style.display = "block";
					i3.reset();
				}
			}
		}
	};
	xhr.open('POST', "php/index-submit.php", true);
	xhr.send(o_form);
})

i50.addEventListener('click', function() {
	i49.scrollIntoView();
	window.scrollBy(0, -i1.offsetHeight);
});