var app = app || {};
$(function () {
	$("#kategori").select2({
		theme: "bootstrap-5",
		placeholder: "Select Station",
		allowClear: true,
		width: "100%",
	});

	$.ajax({
		url: app.base_url + "get_data_kategori",
		type: "POST",
		dataType: "json",
		success: function (res) {
			const list = Array.isArray(res) ? res : res.data || [];
			const $station = $("#kategori").empty();
			list.forEach((r) => {
				$station.append(new Option(r.kategori, r.id_kategori, false, false));
			});
			$station.trigger("change"); // refresh select2
		},
	});
});
