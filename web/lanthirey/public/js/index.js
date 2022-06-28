function f_sys_msg(iType, sMsg) {
	if (iType == -1) {
		sys_msg.style.visibility = 'hidden';
		sys_msg.style.backgroundColor = 'white';
	} else if (iType == 0) {
		sys_msg.innerHTML = sMsg;
		sys_msg.style.color = 'white';
		sys_msg.style.visibility = 'visible';
		sys_msg.style.backgroundColor = 'hsl(0, 100%, 50%)';
		setTimeout(f_sys_msg, 6000, -1);
	} else {
		sys_msg.innerHTML = sMsg;
		sys_msg.style.color = 'black';
		sys_msg.style.visibility = 'visible';
		sys_msg.style.backgroundColor = 'hsl(120, 100%, 50%)';
		setTimeout(f_sys_msg, 6000, -1);
	}
}