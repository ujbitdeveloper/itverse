var app = window.app || {};

app.trans = {
	tbl: null,

	init: function () {
		this.init_table_approval();
		this.selesai_action();
		this.asign_action();
	},

	init_table_approval: function () {
		const $table = $("#tblApproval");
		this.tbl = $table.DataTable({
			responsive: false,
			serverSide: false,
			ordering: true,
			retrieve: true,
			processing: true,
			ajax: {
				//ini url yang ada dicontroller cek urlnya diroutes
				url: app.base_url + "data_approval_service",
				type: "POST",
				dataType: "JSON",
			},
			columns: [
				// ada beberapa data yang ditunjukan sesuai data dari controller, jumlah column diview harus sesuai
				// dengan yang diinputkan disini

				{ data: "no" },
				{ data: "id_request" },
				{ data: "nama_karyawan" },
				{ data: "kategori" },
				{ data: "created_date" },
				{ data: "keterangan_pengerjaan" },
				{ data: "nama_status" },

				{
					data: null,
					orderable: false,
					className: "action",
					render: function (data) {
						if (data.id_status == 1) {
							return `
							<div class="action-group" style="display: flex; justify-content: center; align-items: center;">
								<button type="button" class="btn btn-primary btn-approve" onclick="approveAction('${data.id_request}')">
									Approve
								</button>
							</div>`;
						} else {
							return `
							<div class="action-group" style="display: flex; justify-content: center; align-items: center; gap: 8px;">
								<button type="button" class="btn btn-success btn-selesaiPengerjaan">
									Selesai Pengerjaan
								</button>
								<button type="button" class="btn btn-danger btn-asign">
									Asign
								</button>
							</div>
							`;
						}
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
	selesai_action: function () {
		const self = this;
		$("#tblApproval").on("click", ".btn-selesaiPengerjaan", function (e) {
			e.preventDefault();
			let tr = $(this).closest("tr");
			let row = self.tbl.row(tr);
			if (tr.hasClass("child")) {
				row = self.tbl.row(tr.prev());
			}

			const data = row.data() || {};
			$("#idTransaksiSelesai").val(data.id_request || "");

			const modalEl = document.querySelector(".bd-finish-modal-lg");
			const modal = bootstrap.Modal.getOrCreateInstance(modalEl);
			modal.show();
		});
	},
	asign_action: function () {
		const self = this;
		$("#tblApproval").on("click", ".btn-asign", function (e) {
			e.preventDefault();
			let tr = $(this).closest("tr");
			let row = self.tbl.row(tr);
			if (tr.hasClass("child")) {
				row = self.tbl.row(tr.prev());
			}

			const data = row.data() || {};
			$("#idTransaksiAsign").val(data.id_request || "");

			const modalEl = document.querySelector(".bd-asign-modal-lg");
			const modal = bootstrap.Modal.getOrCreateInstance(modalEl);
			modal.show();
		});
	},
};

function approveAction(id) {
	if (confirm("Are you sure you want to approve?")) {
		window.location.href = app.base_url + "approve_service/" + id;
	}
}

jQuery(document).ready(function () {
	app.trans.init();
});
