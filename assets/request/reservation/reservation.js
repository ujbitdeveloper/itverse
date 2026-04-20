var app = window.app || {};

app.trans = {
	tbl: null,

	init: function () {
		this.init_table_reservation();
		this.bind_events();
	},

	init_table_reservation: function () {
		const $table = $("#tblReservation");
		this.tbl = $table.DataTable({
			responsive: false,
			serverSide: false,
			ordering: true,
			retrieve: true,
			processing: true,
			ajax: {
				//ini url yang ada dicontroller cek urlnya diroutes
				url: app.base_url + "data_reservation",
				type: "POST",
				dataType: "JSON",
			},
			columns: [
				// ada beberapa data yang ditunjukan sesuai data dari controller, jumlah column diview harus sesuai
				// dengan yang diinputkan disini
				{ data: "no" },
				{ data: "nama" },
				{ data: "ruangan" },
				{ data: "tanggal" },
				{ data: "jam" },
				{ data: "keterangan" },
				{
					data: null,
					orderable: false,
					className: "action",
					render: function (data) {
						return `
							<div class="action-group" style="display: flex; justify-content: center; align-items: center;">
								<button type="button" class="btn btn-warning btn-edit">
									<i class="ti ti-info-circle me-1"></i>Edit
								</button>
							</div>`;
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
	bind_events: function () {
		const self = this;
		// Delegated event ke tabel untuk tombol Edit
		$("#tblReservation").on("click", ".btn-edit", function (e) {
			e.preventDefault();
			// Ambil row data, aman untuk child row
			let tr = $(this).closest("tr");
			let row = self.tbl.row(tr);
			if (tr.hasClass("child")) {
				row = self.tbl.row(tr.prev());
			}
			const data = row.data() || {};

			// mengambil data yang sesuai id di formnya
			$("#id").val(data.id_booking || "");
			$("#keterangan_edit").val(data.keterangan || "");
			$("#tanggal_edit").val(data.tanggal || "");
			$("#jam_dari_edit").val(data.jam_mulai || "");
			$("#jam_dari_edit").val(data.jam_selesai || "");

			var typeOption = new Option(data.type, data.type, true, true);
			$("#Ruangan_edit").append(typeOption).trigger("change");

			var stationOption = new Option(
				data.nama_ruangan,
				data.id_ruangan,
				true,
				true,
			);
			$("#Ruangan_edit").append(stationOption).trigger("change");

			// Tampilkan modal
			const modalEl = document.querySelector(".bd-reservation-modal-lg");
			const modal = bootstrap.Modal.getOrCreateInstance(modalEl);
			modal.show();
		});
	},
};

function nonActive(id) {
	// Konfirmasikan tindakan reset password
	if (confirm("Are you sure you want to non active this Charger?")) {
		// Arahkan ke URL reset password di controller dengan membawa id pengguna
		window.location.href = app.base_url + "data/charger_data/nonActive/" + id;
	}
}
jQuery(document).ready(function () {
	app.trans.init();
});
