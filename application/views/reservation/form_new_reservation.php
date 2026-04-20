<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('layout/header_style') ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/style/select2/select2-bootstrap-5-theme.min.css">

<body data-pc-preset="preset-1" data-pc-direction="ltr" data-pc-theme="light">
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <?php $this->load->view('layout/sidebar') ?>
    <?php $this->load->view('layout/header_dashboard') ?>

    <!-- [ Main Content ] start -->
    <section class="pc-container">
        <div class="pc-content">

            <div class="page-header">
                <?php
                $data['data_header'] = array(
                    'site_url' => "reservation",
                    'master_nav' => "Reservation",
                    'active_nav' => "Form New Reservation",
                    'page_header_tittle' => "Form New Reservation",
                );
                $this->load->view('layout/form_content_header', $data)
                ?>
            </div>

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Form Input Reservation</h5>
                    </div>
                    <div class="card-body">
                        <form id="userForm" action="<?php echo site_url('insert_reservation') ?>" autocomplete="off" method="post">
                            <div class="col-md-12">
                                <div class="form-floating mb-0">
                                    <div class="form-group">
                                        <label class="form-label" for="Ruangan">Ruangan</label>
                                        <select class="form-select" id="Ruangan" name="Ruangan">
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="keterangan">Keterangan</label>
                                        <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Meeting Fueling">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-0">
                                        <div class="form-group">
                                            <label class="form-label" for="tanggal">Tanggal</label>
                                            <input type="date" class="form-control" id="tanggal" name="tanggal">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="jam_dari">Jam Dari</label>
                                        <input type="time" class="form-control" id="jam_dari" name="jam_dari" placeholder="UJB_TESTERATESS_2">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-0">
                                        <div class="form-group">
                                            <label class="form-label" for="jam_sampai">Jam Sampai</label>
                                            <input type="time" class="form-control" id="jam_sampai" name="jam_sampai" placeholder="EVA-07S">
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
    </section>

    <?php $this->load->view('layout/footer') ?>

    <script type="text/javascript" src="<?php echo base_url('assets/request/reservation/form_reservation.js?v=') . time(); ?>"></script>

    <!-- [Page Specific JS] end -->
</body>
<!-- [Body] end -->

</html>