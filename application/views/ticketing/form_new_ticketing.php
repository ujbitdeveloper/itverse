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
                    'site_url' => "ticket",
                    'master_nav' => "Ticket",
                    'active_nav' => "Form New Ticket",
                    'page_header_tittle' => "Form New Ticket",
                );
                $this->load->view('layout/form_content_header', $data)
                ?>
            </div>

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Form Input Ticket</h5>
                    </div>
                    <div class="card-body">
                        <form id="userForm" action="<?php echo site_url('insert_service') ?>" autocomplete="off" method="post">
                            <div class="col-md-12">
                                <div class="form-floating mb-0">
                                    <div class="form-group">
                                        <label class="form-label" for="kategori">Kategori</label>
                                        <select class="form-select" id="kategori" name="kategori">
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating mb-0">
                                    <div class="form-group">
                                        <label class="form-label">Keterangan Request</label>
                                        <textarea name="keterangan_request" class="form-control" rows="5" placeholder="Masukkan keluhan / request service..." required></textarea>
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

    <script type="text/javascript" src="<?php echo base_url('assets/request/ticketing/form_ticketing.js?v=') . time(); ?>"></script>

    <!-- [Page Specific JS] end -->
</body>
<!-- [Body] end -->

</html>