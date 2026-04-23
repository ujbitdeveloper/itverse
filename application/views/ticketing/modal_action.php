<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/style/select2/select2-bootstrap-5-theme.min.css">


<div class="card-body pc-component">
    <div class="modal fade bd-asign-modal-lg" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h4" id="myLargeModalLabel">Asign Service</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="userForm" action="<?php echo site_url('asign_service') ?>" autocomplete="off" method="post">
                        <input type="hidden" id="idTransaksiAsign" name="idTransaksiAsign">
                        <div class="col-md-12">
                            <div class="form-floating mb-0">
                                <div class="form-group">
                                    <label class="form-label" for="karyawan">Karyawan</label>
                                    <select class="form-select" id="karyawan" name="karyawan">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row g-4">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label" for="keterangan">Keterangan</label>
                                    <textarea name="keterangan_selesai_asign" class="form-control" rows="5" placeholder="Masukkan alasan asign kerekan kerja.." required></textarea>
                                </div>
                            </div>
                        </div>

                        <hr>
                        <?php $this->load->view('layout/button_group_form') ?>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="card-body pc-component">
    <div class="modal fade bd-finish-modal-lg" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h4" id="myLargeModalLabel">Selesai Service</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="userForm" action="<?php echo site_url('finish_service') ?>" autocomplete="off" method="post">
                        <input type="hidden" id="idTransaksiSelesai" name="idTransaksiSelesai">
                        <div class="row g-4">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label" for="keterangan">Keterangan</label>
                                    <textarea name="keterangan_selesai_service" class="form-control" rows="5" placeholder="Masukkan keluhan / request service..." required></textarea>
                                </div>
                            </div>
                        </div>

                        <hr>
                        <?php $this->load->view('layout/button_group_form') ?>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="<?php echo base_url('assets/request/ticketing/form_modal_action.js?v=') . time(); ?>"></script>