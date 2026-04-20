var app = app || {};
$(function () {
	$("#Ruangan_edit").select2({
		theme: "bootstrap-5",
		placeholder: "Select Station",
		allowClear: true,
		width: "100%",
	});

	$.ajax({
		url: app.base_url + "get_data_ruangan",
		type: "POST",
		dataType: "json",
		success: function (res) {
			const list = Array.isArray(res) ? res : res.data || [];
			const $station = $("#Ruangan_edit").empty();
			list.forEach((r) => {
				$station.append(new Option(r.nama_ruangan, r.id_ruangan, false, false));
			});
			$station.trigger("change"); // refresh select2
		},
	});
});
