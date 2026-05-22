var app = window.app || {};

app.trans = {
	tbl: null,

	init: function () {
		this.init_table_guest();
	},

	init_table_guest: function () {
		const $table = $("#tblGuest");
		this.tbl = $table.DataTable({
			responsive: false,
			serverSide: false,
			ordering: true,
			retrieve: true,
			processing: true,
			ajax: {
				//ini url yang ada dicontroller cek urlnya diroutes
				url: app.base_url + "get_data_guest",
				type: "POST",
				dataType: "JSON",
			},
			columns: [
				// ada beberapa data yang ditunjukan sesuai data dari controller, jumlah column diview harus sesuai
				// dengan yang diinputkan disini

				{ data: "no" },
				{ data: "nama_lengkap" },
				{
					data: null,
					orderable: false,
					className: "action",
					render: function (data) {
						return `
							<div class="action-group" style="display: flex; justify-content: center; align-items: center;">
								<button type="button" class="btn btn-${data.button_color} btn-edit">
									${data.type_guest}
								</button>
							</div>`;
					},
				},
				{ data: "no_tlp" },
				{ data: "posisi_lamaran" },
				{ data: "tanggal" },
				{ data: "instansi" },
				{ data: "bertemu_dengan" },
				{ data: "keperluan" },
				{
					data: "foto",
					render: function (data) {
						return `
						<div style="display:flex; justify-content:center;">
							<img 
								src="${base_url}assets/resource/img/${data}" 
								alt="foto"
								width="100"
								height="100"
								style="
									object-fit:cover;
									border:1px solid #ccc;
									border-radius:8px;
								"
							>
						</div>
					`;
					},
				},
			],
			select: true,
			createdRow: function (row, data, dataIndex) {
				if (data.akurasi == 1) {
					$(row).addClass("highlight");
				}
			},
		});
		// Event listener untuk tombol filter
		$("#filterDate").on("click", function () {
			tbl.ajax.reload();
		});
	},
};

jQuery(document).ready(function () {
	app.trans.init();
});
