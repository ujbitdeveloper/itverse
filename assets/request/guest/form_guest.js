var app = app || {};
$(function () {
	$("#id_jenis").select2({
		theme: "bootstrap-5",
		placeholder: "Select ruangan",
		allowClear: true,
		width: "100%",
	});

	const $typeCard = $("#id_jenis");
	const $nama_lengkap = $("#nama_lengkap").closest(".mb-3");
	const $no_tlp = $("#no_tlp").closest(".mb-3");
	const $alamat = $("#alamat").closest(".mb-3");
	const $posisi = $("#posisi").closest(".mb-3");
	const $instansi = $("#instansi").closest(".mb-3");
	const $tujuan = $("#tujuan").closest(".mb-3");
	const $keperluan = $("#keperluan").closest(".mb-3");

	$.ajax({
		url: app.base_url + "get_data_kategori",
		type: "POST",
		dataType: "json",
		success: function (res) {
			const list = Array.isArray(res) ? res : res.data || [];
			const $kategori = $("#id_jenis").empty();
			list.forEach((r) => {
				$kategori.append(new Option(r.type_guest, r.id_type, false, false));
			});
			$kategori.trigger("change"); // refresh select2
		},
	});

	$typeCard.on("change", function () {
		const selectedId = $(this).val();
		if (selectedId === "1") {
			$alamat.hide();
			$posisi.hide();

			$instansi.show();
			$tujuan.show();
			$keperluan.show();
		} else {
			$instansi.hide();
			$tujuan.hide();
			$keperluan.hide();

			$posisi.show();
			$alamat.show();
		}
	});
});
