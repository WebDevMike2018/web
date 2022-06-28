const o_bs = {
	a_months: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
	a_schedule: [],
	o_schedule: {},

	f_date_click: function(e) {
		if (this.classList.contains("bs8")) {
			return;
		} else {
			o_bs.o_schedule.s_index = this.dataset.index;
			id_bs4.style.visibility = "visible";
			id_bs4.innerHTML = "";
			let e1 = document.querySelector("#id_bs2 .bs8");
			if (e1) {e1.classList.remove("bs8");}
			this.classList.add("bs8");
			let i_index = parseInt(this.dataset.index);
			for (let i = 0; i < o_bs.a_schedule[i_index][1].length; i++) {
				if (o_bs.a_schedule[i_index][1][i].available == 1 && o_bs.a_schedule[i_index][1][i].reserved == 0) {
					let e2 = document.createElement("div");
					e2.classList.add("bs11");
					e2.innerText = o_bs.a_schedule[i_index][1][i].time;
					e2.addEventListener("click", o_bs.f_time_click);
					id_bs4.append(e2);
				}
			}
		}
	},

	f_calendar_create: function() {
		// set month
		let o_date = new Date(o_bs.a_schedule[0][0]);
		id_bs1.innerHTML = o_bs.a_months[o_date.getMonth()];
		// pad to first day of month
		let o_date1 = new Date(o_bs.a_schedule[0][0]);
		o_date1.setDate(1);
		let i_day = o_date1.getDay();
		if (i_day > 0) {
			for (let i = 0; i < i_day; i++) {
				let e1 = document.createElement('div');
				e1.classList.add("bs6")
				id_bs2.append(e1);
			}
		}
		// pad to o_bs.a_schedule[0][0]
		if (o_date.getDate() != 1) {
			i_day = o_date.getDate();
			for (let i = 1; i < i_day; i++) {
				let e1 = document.createElement('div');
				e1.classList.add("bs6", "bs7");
				e1.innerHTML = i;
				id_bs2.append(e1);
			}
		}
		// add o_bs.a_schedule
		for (let i = 0; i < o_bs.a_schedule.length; i++) {
			let o_date = new Date(o_bs.a_schedule[i][0]);
			if (o_date.getDate() == 1) {
				// add new month
				let e1 = document.createElement('div');
				e1.classList.add("bs3");
				e1.innerHTML = o_bs.a_months[o_date.getMonth()];
				id_bs2.append(e1);
				// pad to first day of month
				let i_day = o_date.getDay();
				if (i_day > 0) {
					for (let i = 0; i < i_day; i++) {
						let e1 = document.createElement('div');
						e1.classList.add("bs6")
						id_bs2.append(e1);
					}
				}
			}
			let e1 = document.createElement('div');
			e1.classList.add("bs6", "bs7");
			for (let i1 = 0; i1 < o_bs.a_schedule[i][1].length; i1++) {
				if (o_bs.a_schedule[i][1][i1].available == 1 && o_bs.a_schedule[i][1][i1].reserved == 0) {
					e1.classList.remove("bs7");
					e1.classList.add("bs9");
					e1.addEventListener("click", o_bs.f_date_click);
					break;
				}
			}
			e1.innerHTML = o_date.getDate();
			e1.dataset.date = o_bs.a_schedule[i][0];
			e1.dataset.index = i;
			id_bs2.append(e1);
		}
	},

	f_time_click: function(e) {
		if (this.classList.contains("bs8")) {
			return;
		} else {
			o_bs.o_schedule.s_time = this.innerText;
			this.classList.add("bs8");
		}
	},
};

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

fetch("php/index.php")
.then(response => response.json())
.then(data => {
	o_bs.a_schedule = data;
	o_bs.f_calendar_create();
});