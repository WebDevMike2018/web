<!DOCTYPE html>
<html lang='en'>
<head>
<meta charset='UTF-8'>
<meta name='viewport' content='width=device-width, initial-scale=1.0'>
<meta name='web-author' content='Michael Griffiths (contact@webdevmike.com)'>
<link rel='stylesheet' href='css/manage.css?ver=1'>
<title>Manage</title>
</head>
<body>
<div id='sys_msg' class='sys_msg'></div>
<div id="i21" class='c14'>
	<div class="c15"><img id='i22' class='c17' src="media/image/close.svg"></div>
	<div id='i23'></div>
</div>
<div class="c1">
	<div id='i1' class='active'>Orders</div>
	<div id='i2'>Schedule</div>
</div>
<div id="i3">
	<div class='c7'>
		<div id='i24' class='active'>Pending</div>
		<div id='i25'>Past</div>
	</div>
	<div class='c8'>
		<div class="c9">
			<div class="c3"><input id='i17' class='c4' type="text" placeholder="order number"></div>
			<div class="c6"><div id='i20' class="c5">SEARCH</div></div>
		</div>
	</div>
	<div id="i4" class='c2'>
		<div id='i18'></div>
		<div class="c10"><div id='i19' class="c5">Load More</div></div>
	</div>
	<div id="i5" class='c0'>
		<div id='i26'></div>
		<div class="c10"><div id='i27' class="c5">Load More</div></div>
	</div>
</div>
<div id="i7" class="c0">
	<div class="schedule1">
		<div class="schedule4">
			<div id="i8" class="schedule2"></div>
			<div class="schedule3">
				<div>Sun</div>
				<div>Mon</div>
				<div>Tue</div>
				<div>Wed</div>
				<div>Thu</div>
				<div>Fri</div>
				<div>Sat</div>
			</div>
			<div id="i9"></div>
		</div>
		<div class='schedule9'>
			<div><div class="schedule10" data-time="0">6:00 AM</div><div class="schedule10" data-time="1">6:30 AM</div></div>
			<div><div class="schedule10" data-time="2">7:00 AM</div><div class="schedule10" data-time="3">7:30 AM</div></div>
			<div><div class="schedule10" data-time="4">8:00 AM</div><div class="schedule10" data-time="5">8:30 AM</div></div>
			<div><div class="schedule10" data-time="6">9:00 AM</div><div class="schedule10" data-time="7">9:30 AM</div></div>
			<div><div class="schedule10" data-time="8">10:00 AM</div><div class="schedule10" data-time="9">10:30 AM</div></div>
			<div><div class="schedule10" data-time="10">11:00 AM</div><div class="schedule10" data-time="11">11:30 AM</div></div>
			<div><div class="schedule10" data-time="12">12:00 PM</div><div class="schedule10" data-time="13">12:30 PM</div></div>
			<div><div class="schedule10" data-time="14">1:00 PM</div><div class="schedule10" data-time="15">1:30 PM</div></div>
			<div><div class="schedule10" data-time="16">2:00 PM</div><div class="schedule10" data-time="17">2:30 PM</div></div>
			<div><div class="schedule10" data-time="18">3:00 PM</div><div class="schedule10" data-time="19">3:30 PM</div></div>
			<div><div class="schedule10" data-time="20">4:00 PM</div><div class="schedule10" data-time="21">4:30 PM</div></div>
			<div><div class="schedule10" data-time="22">5:00 PM</div><div class="schedule10" data-time="23">5:30 PM</div></div>
			<div><div class="schedule10" data-time="24">6:00 PM</div><div class="schedule10" data-time="25">6:30 PM</div></div>
			<form id='i14'>
				<input id='i13' type="hidden" name="s_date">
				<input id='i16' type="hidden" name="s_day">
				<div class='schedule13'><input type="checkbox" name="j_date" id="i11"> <label for="i11">Use this schedule for all following <span id='i12'></span></label></div>
				<div class='schedule12'><button type="submit" class='schedule11'>SUBMIT</button></div>
			</form>
		</div>
	</div>
</div>
<script src='js/manage.js'></script>
</body>
</html>