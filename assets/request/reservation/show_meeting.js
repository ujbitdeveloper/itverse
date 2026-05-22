var app = app || {};

(function () {
	// ======================
	// CLOCK
	// ======================
	function updateClock() {
		const now = new Date();

		const clockEl = document.getElementById("clock");
		const dateEl = document.getElementById("date");

		if (!clockEl || !dateEl) return;

		clockEl.textContent = now.toLocaleTimeString("en-US", {
			hour: "2-digit",
			minute: "2-digit",
			second: "2-digit",
			hour12: true,
			timeZone: "Asia/Jakarta",
		});

		dateEl.textContent = now.toLocaleDateString("en-US", {
			weekday: "long",
			day: "2-digit",
			month: "long",
			year: "numeric",
			timeZone: "Asia/Jakarta",
		});
	}

	function startClock() {
		updateClock();
		setInterval(updateClock, 1000);
	}

	// ======================
	// LOAD MEETING
	// ======================
	async function loadMeeting() {
		try {
			const res = await fetch(`${BASE_URL}get_meeting_api/${roomId}`);
			const data = await res.json();

			if (!data.status) return;

			const list = data.list_meeting || [];
			const namaRuangan = data.ruangan || "";
			const current = data.current_meeting;

			// HEADER
			setText("roomName", namaRuangan || "RUANGAN");
			setText("roomHeader", namaRuangan || "RUANGAN");

			// CURRENT MEETING
			setText(
				"meetingTitle",
				current ? current.keterangan : "TIDAK ADA MEETING",
			);

			setText(
				"meetingTime",
				current ? `${current.jam_mulai} - ${current.jam_selesai}` : "-",
			);

			setText("meetingStatus", current ? "IN MEETING" : "KOSONG");
			setText("meetingBy", current ? current.nama : "-");

			// LIST
			const container = document.getElementById("meetingList");
			if (!container) return;

			container.innerHTML = "";

			const now = new Date().toLocaleTimeString("en-GB", {
				hour12: false,
				timeZone: "Asia/Jakarta",
			});

			list.forEach((m) => {
				let st_txt = "";
				let st_cls = "";

				if (now < m.jam_mulai) {
					st_txt = "UPCOMING";
					st_cls = "upcoming";
				} else if (now >= m.jam_mulai && now <= m.jam_selesai) {
					st_txt = "IN PROGRESS";
					st_cls = "in-progress";
				} else {
					st_txt = "ENDED";
					st_cls = "ended";
				}

				const card = `
				<div class="card ${st_cls} ${st_cls === "in-progress" ? "active" : ""}">
					<div class="card-header-status">
						<h3>${m.keterangan}</h3>
						<span class="badge">${st_txt}</span>
					</div>
					<p>
						${m.jam_mulai} - ${m.jam_selesai} | ${m.nama}
					</p>
				</div>
				`;

				container.innerHTML += card;
			});
		} catch (err) {
			console.error("LOAD MEETING ERROR:", err);
		}
	}

	// ======================
	// HELPER
	// ======================
	function setText(id, value) {
		const el = document.getElementById(id);
		if (el) el.textContent = value;
	}

	// ======================
	// INIT
	// ======================
	document.addEventListener("DOMContentLoaded", function () {
		if (typeof BASE_URL === "undefined" || typeof roomId === "undefined") {
			console.error("BASE_URL atau roomId belum didefinisikan!");
			return;
		}

		startClock();
		loadMeeting();

		setInterval(loadMeeting, 100000);
		setInterval(() => location.reload(), 1000000);
	});
})();
