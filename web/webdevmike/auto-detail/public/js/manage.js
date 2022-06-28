// Variables
const a_days = ["Sundays", "Mondays", "Tuesdays", "Wednesdays", "Thursdays", "Fridays", "Saturdays"];
const a_months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
const a_schedule10 = document.querySelectorAll(".schedule10");
let a_date, a_time, i_a_date_index, i_pastOffset, i_pendingOffset;
i_pastOffset = i_pendingOffset = 0;

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
		setTimeout(f_sys_msg, 5000, -1);
	} else {
		o_sys_msg.innerHTML = s_msg;
		o_sys_msg.style.color = 'black';
		o_sys_msg.style.visibility = 'visible';
		o_sys_msg.style.backgroundColor = 'hsl(120, 100%, 50%)';
		setTimeout(f_sys_msg, 5000, -1);
	}
}

function f_cancelOrder() {
	let x = this;
	let s_order = this.dataset.order;
	let s_date = this.dataset.date;
	let s_time = this.dataset.time;
	let xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			if (this.responseText != '') {
				let a_response = JSON.parse(this.responseText);
				if (a_response[0] == 0) {
					f_sys_msg(a_response[0], a_response[1]);
				}
				if (a_response[0] == 1) {
					f_sys_msg(a_response[0], a_response[1]);
					x.style.display = "none";
				}
			}
		}
	};
	xhr.open('GET', `php/manage-cancel.php?order=${s_order}&date=${s_date}&time=${s_time}`, true);
	xhr.send();
}

// Invoke
for (let i = 1; i < 28; i++) {
	let str = "const i" + i + " = document.getElementById('i" + i + "');";
	eval(str);
}

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
				switch (this) {
					case a1[0]:
						i4.style.display = "block";
						break;
					case a1[1]:
						i5.style.display = "block";
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
				if (this.dataset.reserved == 1) {
					if (confirm("This time slot is already reserved. Removing this time slot will not cancel the appointment.")) {
						this.classList.remove('active');
						let i_index = parseInt(this.dataset.time);
						a_time[i_a_date_index][i_index].scheduled = 0;
					}
				} else {
					this.classList.remove('active');
					let i_index = parseInt(this.dataset.time);
					a_time[i_a_date_index][i_index].scheduled = 0;
				}
			} else {
				this.classList.add('active');
				let i_index = parseInt(this.dataset.time);
				a_time[i_a_date_index][i_index].scheduled = 1;
			}
		});
	});
})();

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
										value.dataset.reserved = "0";
										if (value.classList.contains("active")) {
											value.classList.remove("active");
										}
									});
									i_a_date_index = a_date.indexOf(s_date);
									for (let i = 0; i < 26; i++) {
										if (a_time[i_a_date_index][i].scheduled == 1) { 
											a_schedule10[i].classList.add('active');
											if (a_time[i_a_date_index][i].reserved == 1) {
												a_schedule10[i].dataset.reserved = "1";
											}
										}
									}
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
/*
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
				if (this.dataset.reserved == 1) {
					if (confirm("This time slot is already reserved. Removing this time slot will not cancel the appointment.")) {
						this.classList.remove('active');
						let i_index = parseInt(this.dataset.time);
						a_time[i_a_date_index][i_index].scheduled = 0;
					}
				}
			} else {
				this.classList.add('active');
				let i_index = parseInt(this.dataset.time);
				a_time[i_a_date_index][i_index].scheduled = 1;
			}
		});
	});
})();
*/

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

i19.addEventListener('click', function() {
	let xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			if (this.responseText != '') {
				let a_response = JSON.parse(this.responseText);
				if (a_response[0] == 0) {
					f_sys_msg(a_response[0], a_response[1]);
				}
				if (a_response[0] == 1) {
					if (a_response[1].length > 0) {
						a_response[1].forEach(function(value) {
							let e1 = document.createElement('div');
							e1.classList.add('c10');
							let e2 = document.createElement('div');
							e2.classList.add('c11');
							let e3 = document.createElement('div');
							e3.classList.add('c12');
							e3.innerHTML = "Order: " + value[0];
							let e4 = document.createElement('table');
							e4.classList.add('c13');
							let e5 = document.createElement('tr');
							let e6 = document.createElement('td');
							e6.innerHTML = "Date:";
							let e7 = document.createElement('td');
							e7.innerHTML = value[3];
							e5.append(e6);
							e5.append(e7);
							e4.append(e5);
							let e8 = document.createElement('tr');
							let e9 = document.createElement('td');
							e9.innerHTML = "Time:";
							let e10 = document.createElement('td');
							e10.innerHTML = value[5];
							e8.append(e9);
							e8.append(e10);
							e4.append(e8);
							let e11 = document.createElement('tr');
							let e12 = document.createElement('td');
							e12.innerHTML = "Service:"
							let e13 = document.createElement('td');
							e13.innerHTML = value[2];
							e11.append(e12);
							e11.append(e13);
							e4.append(e11);
							let e14 = document.createElement('tr');
							let e15 = document.createElement('td');
							e15.innerHTML = "Make:";
							let e16 = document.createElement('td');
							e16.innerHTML = value[6];
							e14.append(e15);
							e14.append(e16);
							e4.append(e14);
							let e17 = document.createElement('tr');
							let e18 = document.createElement('td');
							e18.innerHTML = "Model:";
							let e19 = document.createElement('td');
							e19.innerHTML = value[7];
							e17.append(e18);
							e17.append(e19);
							e4.append(e17);
							let e20 = document.createElement('tr');
							let e21 = document.createElement('td');
							e21.innerHTML = "Color:";
							let e22 = document.createElement('td');
							e22.innerHTML = value[8];
							e20.append(e21);
							e20.append(e22);
							e4.append(e20);
							let e23 = document.createElement('tr');
							let e24 = document.createElement('td');
							e24.innerHTML = "Address:";
							let e25 = document.createElement('td');
							e25.innerHTML = value[9];
							e23.append(e24);
							e23.append(e25);
							e4.append(e23);
							let e26 = document.createElement('tr');
							let e27 = document.createElement('td');
							e27.innerHTML = "Name:";
							let e28 = document.createElement('td');
							e28.innerHTML = value[10] + " " + value[11];
							e26.append(e27);
							e26.append(e28);
							e4.append(e26);
							let e29 = document.createElement('tr');
							let e30 = document.createElement('td');
							e30.innerHTML = "Phone:";
							let e31 = document.createElement('td');
							e31.innerHTML = value[12];
							e29.append(e30);
							e29.append(e31);
							e4.append(e29);
							let e32 = document.createElement('tr');
							let e33 = document.createElement('td');
							e33.innerHTML = "Email:";
							let e34 = document.createElement('td');
							e34.innerHTML = value[13];
							let e35 = document.createElement('div');
							e35.classList.add('c5');
							e35.dataset.order = value[0];
							e35.dataset.date = value[3];
							e35.dataset.time = value[4];
							e35.addEventListener('click', f_cancelOrder)
							e35.innerHTML = "CANCEL";
							let e36 = document.createElement('div');
							e36.classList.add('c6');
							e36.append(e35);
							e32.append(e33);
							e32.append(e34);
							e4.append(e32);
							e2.append(e3);
							e2.append(e4);
							if (value[1] == 1) {
								
							}
							e2.append(e36);
							e1.append(e2);
							i18.append(e1);
						});
						i_pendingOffset += 10;
						if (a_response[1].length < 10) {
							i19.style.display = "none";
						}
					} else {
						i19.style.display = "none";
					}
				}
			}
		}
	};
	xhr.open('GET', "php/manage-get-pending.php?offset=" + i_pendingOffset, true);
	xhr.send();
});
i19.click();

i20.addEventListener('click', function() {
	let xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			if (this.responseText != '') {
				let a_response = JSON.parse(this.responseText);
				if (a_response[0] == 0) {
					f_sys_msg(a_response[0], a_response[1]);
				}
				if (a_response[0] == 1) {
					let e1 = document.createElement('div');
					e1.classList.add('c18');
					let e2 = document.createElement('div');
					e2.classList.add('c11');
					let e3 = document.createElement('div');
					e3.classList.add('c12');
					e3.innerHTML = "Order: " + a_response[1][0];
					let e4 = document.createElement('table');
					e4.classList.add('c13');
					let e5 = document.createElement('tr');
					let e6 = document.createElement('td');
					e6.innerHTML = "Date:";
					let e7 = document.createElement('td');
					e7.innerHTML = a_response[1][3];
					e5.append(e6);
					e5.append(e7);
					e4.append(e5);
					let e8 = document.createElement('tr');
					let e9 = document.createElement('td');
					e9.innerHTML = "Time:";
					let e10 = document.createElement('td');
					e10.innerHTML = a_response[1][5];
					e8.append(e9);
					e8.append(e10);
					e4.append(e8);
					let e11 = document.createElement('tr');
					let e12 = document.createElement('td');
					e12.innerHTML = "Service:"
					let e13 = document.createElement('td');
					e13.innerHTML = a_response[1][2];
					e11.append(e12);
					e11.append(e13);
					e4.append(e11);
					let e14 = document.createElement('tr');
					let e15 = document.createElement('td');
					e15.innerHTML = "Make:";
					let e16 = document.createElement('td');
					e16.innerHTML = a_response[1][6];
					e14.append(e15);
					e14.append(e16);
					e4.append(e14);
					let e17 = document.createElement('tr');
					let e18 = document.createElement('td');
					e18.innerHTML = "Model:";
					let e19 = document.createElement('td');
					e19.innerHTML = a_response[1][7];
					e17.append(e18);
					e17.append(e19);
					e4.append(e17);
					let e20 = document.createElement('tr');
					let e21 = document.createElement('td');
					e21.innerHTML = "Color:";
					let e22 = document.createElement('td');
					e22.innerHTML = a_response[1][8];
					e20.append(e21);
					e20.append(e22);
					e4.append(e20);
					let e23 = document.createElement('tr');
					let e24 = document.createElement('td');
					e24.innerHTML = "Address:";
					let e25 = document.createElement('td');
					e25.innerHTML = a_response[1][9];
					e23.append(e24);
					e23.append(e25);
					e4.append(e23);
					let e26 = document.createElement('tr');
					let e27 = document.createElement('td');
					e27.innerHTML = "Name:";
					let e28 = document.createElement('td');
					e28.innerHTML = a_response[1][10] + " " + a_response[1][11];
					e26.append(e27);
					e26.append(e28);
					e4.append(e26);
					let e29 = document.createElement('tr');
					let e30 = document.createElement('td');
					e30.innerHTML = "Phone:";
					let e31 = document.createElement('td');
					e31.innerHTML = a_response[1][12];
					e29.append(e30);
					e29.append(e31);
					e4.append(e29);
					let e32 = document.createElement('tr');
					let e33 = document.createElement('td');
					e33.innerHTML = "Email:";
					let e34 = document.createElement('td');
					e34.innerHTML = a_response[1][13];
					e32.append(e33);
					e32.append(e34);
					e4.append(e32);
					e2.append(e3);
					e2.append(e4);
					if (a_response[1][1] == 1) {
						let e35 = document.createElement('div');
						e35.classList.add('c5');
						e35.dataset.order = a_response[1][0];
						e35.dataset.date = a_response[1][3];
						e35.dataset.time = a_response[1][4];
						e35.addEventListener('click', f_cancelOrder)
						e35.innerHTML = "CANCEL";
						let e36 = document.createElement('div');
						e36.classList.add('c6');
						e36.append(e35);
						e2.append(e36);
					}
					e1.append(e2);
					i23.append(e1);
					i21.style.display = "block";
				}
			}
		}
	};
	xhr.open('GET', "php/manage-get-search.php?q=" + i17.value, true);
	xhr.send();
})

i22.addEventListener('click', function() {
	i21.style.display = "none";
	i23.innerHTML = "";
})

i24.addEventListener('click', function() {
	if (this.classList.contains('active')) {
		return;
	} else {
		i25.classList.remove('active');
		i24.classList.add('active');
		i5.style.display = "none";
		i4.style.display = "block";
	}
});

i25.addEventListener('click', function() {
	if (this.classList.contains('active')) {
		return;
	} else {
		i24.classList.remove('active');
		i25.classList.add('active');
		i4.style.display = "none";
		i5.style.display = "block";
	}
});

i27.addEventListener('click', function() {
	let xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			if (this.responseText != '') {
				let a_response = JSON.parse(this.responseText);
				if (a_response[0] == 0) {
					f_sys_msg(a_response[0], a_response[1]);
				}
				if (a_response[0] == 1) {
					if (a_response[1].length > 0) {
						a_response[1].forEach(function(value) {
							let e1 = document.createElement('div');
							e1.classList.add('c10');
							let e2 = document.createElement('div');
							e2.classList.add('c11');
							let e3 = document.createElement('div');
							e3.classList.add('c12');
							e3.innerHTML = "Order: " + value[0];
							let e4 = document.createElement('table');
							e4.classList.add('c13');
							let e5 = document.createElement('tr');
							let e6 = document.createElement('td');
							e6.innerHTML = "Date:";
							let e7 = document.createElement('td');
							e7.innerHTML = value[3];
							e5.append(e6);
							e5.append(e7);
							e4.append(e5);
							let e8 = document.createElement('tr');
							let e9 = document.createElement('td');
							e9.innerHTML = "Time:";
							let e10 = document.createElement('td');
							e10.innerHTML = value[5];
							e8.append(e9);
							e8.append(e10);
							e4.append(e8);
							let e11 = document.createElement('tr');
							let e12 = document.createElement('td');
							e12.innerHTML = "Service:"
							let e13 = document.createElement('td');
							e13.innerHTML = value[2];
							e11.append(e12);
							e11.append(e13);
							e4.append(e11);
							let e14 = document.createElement('tr');
							let e15 = document.createElement('td');
							e15.innerHTML = "Make:";
							let e16 = document.createElement('td');
							e16.innerHTML = value[6];
							e14.append(e15);
							e14.append(e16);
							e4.append(e14);
							let e17 = document.createElement('tr');
							let e18 = document.createElement('td');
							e18.innerHTML = "Model:";
							let e19 = document.createElement('td');
							e19.innerHTML = value[7];
							e17.append(e18);
							e17.append(e19);
							e4.append(e17);
							let e20 = document.createElement('tr');
							let e21 = document.createElement('td');
							e21.innerHTML = "Color:";
							let e22 = document.createElement('td');
							e22.innerHTML = value[8];
							e20.append(e21);
							e20.append(e22);
							e4.append(e20);
							let e23 = document.createElement('tr');
							let e24 = document.createElement('td');
							e24.innerHTML = "Address:";
							let e25 = document.createElement('td');
							e25.innerHTML = value[9];
							e23.append(e24);
							e23.append(e25);
							e4.append(e23);
							let e26 = document.createElement('tr');
							let e27 = document.createElement('td');
							e27.innerHTML = "Name:";
							let e28 = document.createElement('td');
							e28.innerHTML = value[10] + " " + value[11];
							e26.append(e27);
							e26.append(e28);
							e4.append(e26);
							let e29 = document.createElement('tr');
							let e30 = document.createElement('td');
							e30.innerHTML = "Phone:";
							let e31 = document.createElement('td');
							e31.innerHTML = value[12];
							e29.append(e30);
							e29.append(e31);
							e4.append(e29);
							let e32 = document.createElement('tr');
							let e33 = document.createElement('td');
							e33.innerHTML = "Email:";
							let e34 = document.createElement('td');
							e34.innerHTML = value[13];
							e32.append(e33);
							e32.append(e34);
							e4.append(e32);
							e2.append(e3);
							e2.append(e4);
							e1.append(e2);
							i26.append(e1);
						});
						i_pastOffset += 10;
						if (a_response[1].length < 10) {
							i27.style.display = "none";
						}
					} else {
						i27.style.display = "none";
					}
				}
			}
		}
	};
	xhr.open('GET', "php/manage-get-past.php?offset=" + i_pastOffset, true);
	xhr.send();
});
i27.click();