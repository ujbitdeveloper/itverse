var app = window.app || {};

app.trans = {
	tbl: null,

	init: function () {
		this.init_table_transaction();
		this.bind_events();
	},

	init_table_transaction: function () {
		const $table = $("#tblCharger");
		this.tbl = $table.DataTable({
			responsive: false,
			serverSide: false,
			ordering: true,
			retrieve: true,
			processing: true,
			ajax: {
				//ini url yang ada dicontroller
				url: app.base_url + "data/charger_data/get_data_charger",
				type: "POST",
				dataType: "JSON",
			},
			columns: [
				// ada beberapa data yang ditunjukan sesuai data dari controller, jumlah column diview harus sesuai
				// dengan yang diinputkan disini
				{ data: "no" },
				{ data: "charge_point_id" },
				{ data: "model" },
				{ data: "total_connector" },
				{ data: "type" },
				{ data: "status" },
				{
					data: null,
					orderable: false,
					className: "action",
					render: function (data) {
						return `
							<div class="action-group">
								<button type="button" class="btn btn-primary btn-edit"><i class="ti ti-info-circle me-1"></i>Edit
								</button>
								<button type="button" class="btn btn-warning d-inline-flex"onclick="nonActive(${data.id});">
								<i class="ti ti-triangle me-1"></i>Non Active
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
		$("#tblCharger").on("click", ".btn-edit", function (e) {
			e.preventDefault();
			// Ambil row data, aman untuk child row
			let tr = $(this).closest("tr");
			let row = self.tbl.row(tr);
			if (tr.hasClass("child")) {
				// jika tombol ada di child row, ambil parent row
				row = self.tbl.row(tr.prev());
			}
			const data = row.data() || {};
			console.log("Edit data:", data);

			// mengambil data yang sesuai id di formnya
			$("#id").val(data.id || "");
			$("#charge_point_id_edit").val(data.charge_point_id || "");
			$("#Model_edit").val(data.model || "");
			$("#total_connector_edit").val(data.total_connector || "");

			var typeOption = new Option(data.type, data.type, true, true);
			$("#Type_edit").append(typeOption).trigger("change");

			var stationOption = new Option(
				data.name_station,
				data.id_station,
				true,
				true,
			);
			$("#station_id_edit").append(stationOption).trigger("change");

			// Tampilkan modal
			const modalEl = document.querySelector(".bd-example-modal-lg");
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
