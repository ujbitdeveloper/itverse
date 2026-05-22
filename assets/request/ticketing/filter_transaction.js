var app = app || {};

$(function () {
	const today = new Date();
	const start = new Date(
		today.getFullYear(),
		today.getMonth(),
		today.getDate() - 2,
	);
	const end = today;

	flatpickr("#pc-date_range_picker-4", {
		mode: "range",
		dateFormat: "Y-m-d",
		defaultDate: [start, end],
	});

	function getRange() {
		const v = ($("#pc-date_range_picker-4").val() || "").trim();
		if (!v) return { start: "", end: "" };
		const m = v.split(/\s+to\s+/i);
		return { start: m[0] || "", end: m[1] || m[0] || "" };
	}

	$("#btnDownload").on("click", function (e) {
		const config = document.getElementById("config");
		e.preventDefault();
		const r = getRange();

		const params = new URLSearchParams({
			start: r.start,
			end: r.end,
		});

		window.location.href =
			app.base_url + "export_excel_history?" + params.toString();
	});
	$("#btnReset").on("click", function (e) {
		e.preventDefault();
		// reset daterange (sesuaikan plugin yg dipakai)
		$("#pc-date_range_picker-4").val(""); // atau set default via plugin
		// reset select2
		tbl.ajax.reload(null, true);
	});
});
