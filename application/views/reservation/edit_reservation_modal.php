<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('layout/header_style') ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/style/select2/select2-bootstrap-5-theme.min.css">


<div class="card-body pc-component">
    <div class="modal fade bd-reservation-modal-lg" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h4" id="myLargeModalLabel">Edit Data Reservation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="userForm" action="<?php echo site_url('data/charger_data/edit_charger') ?>" autocomplete="off" method="post">
                        <input type="hidden" id="id" name="id">
                        <div class="col-md-12">
                            <div class="form-floating mb-0">
                                <div class="form-group">
                                    <label class="form-label" for="Ruangan_edit">Ruangan</label>
                                    <select class="form-select" id="Ruangan_edit" name="Ruangan_edit">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="keterangan_edit">Keterangan</label>
                                    <input type="text" class="form-control" id="keterangan_edit" name="keterangan_edit" placeholder="Meeting Fueling">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-0">
                                    <div class="form-group">
                                        <label class="form-label" for="tanggal_edit">Tanggal</label>
                                        <input type="date" class="form-control" id="tanggal_edit" name="tanggal_edit">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="jam_dari_edit">Jam Dari</label>
                                    <input type="time" class="form-control" id="jam_dari_edit" name="jam_dari_edit" placeholder="UJB_TESTERATESS_2">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-0">
                                    <div class="form-group">
                                        <label class="form-label" for="jam_sampai_edit">Jam Sampai</label>
                                        <input type="time" class="form-control" id="jam_sampai_edit" name="jam_sampai_edit" placeholder="EVA-07S">
                                    </div>
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

<script type="text/javascript" src="<?php echo base_url('assets/request/reservation/form_edit_reservation.js?v=') . time(); ?>"></script>