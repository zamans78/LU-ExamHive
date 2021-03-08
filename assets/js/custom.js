function showTime() {
	var date = new Date();
	var h = date.getHours(); // 0 - 23
	var m = date.getMinutes(); // 0 - 59
	var s = date.getSeconds(); // 0 - 59
	var session = "AM";

	if (h == 0) {
		h = 12;
	}

	if (h > 12) {
		h = h - 12;
		session = "PM";
	}

	h = h < 10 ? "0" + h : h;
	m = m < 10 ? "0" + m : m;
	s = s < 10 ? "0" + s : s;

	var time = h + ":" + m + ":" + s + " " + session;
	document.getElementById("ExamClock").innerText = time;
	document.getElementById("ExamClock").textContent = time;

	setTimeout(showTime, 1000);
}

showTime();



/*-- Password Toggle --*/

function togglePassword() {


	var state1 = document.getElementById("exampleInputPassword1");
	var state2 = document.getElementById("hide1");
	var state3 = document.getElementById("hide2");

	if (state1.type === "password") {
		state1.type = "text";
		state2.style.display = "block";
		state3.style.display = "none";
	}
	else {
		state1.type = "password";
		state2.style.display = "none";
		state3.style.display = "block";
	}
}