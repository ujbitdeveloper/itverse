var app = app || {};
$(function () {
	$("#karyawan").select2({
		theme: "bootstrap-5",
		placeholder: "Select Karyawan",
		allowClear: true,
		width: "100%",
	});

	$.ajax({
		url: app.base_url + "get_data_karyawan",
		type: "POST",
		dataType: "json",
		success: function (res) {
			console.log(res.data);
			const list = Array.isArray(res) ? res : res.data || [];
			const $karyawan = $("#karyawan").empty();
			list.forEach((r) => {
				$karyawan.append(
					new Option(r.nama_karyawan, r.id_karyawan, false, false),
				);
			});
			$karyawan.trigger("change"); // refresh select2
		},
	});
});
