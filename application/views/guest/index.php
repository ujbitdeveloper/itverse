<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('layout/header_style') ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/style/css/table.css">

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
            <?php
            $data['data_header'] = array(
                'master_nav' => "Guest Book",
                'active_nav' => "List Guest",
                'page_header_tittle' => "List Guest Page",
                'button_input_data' => "/chargers/input_new_charger",

            );
            $this->load->view('layout/page_content_header', $data)
            ?>
            <!-- [ Main Content ] start -->
            <div class="row">

                <!-- [ basic-table ] start -->
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Guest Book</h5>
                        </div>
                        <div class="card-body table-border-style">
                            <div class="table-responsive" id="pc-dt-filter">
                                <section class="table-section">
                                    <table id="tblGuest" class="table table-striped table-bordered nowrap">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>status</th>
                                                <th>No Telepon</th>
                                                <th>Posisi</th>
                                                <th>Tanggal / Jam</th>
                                                <th>Instansi</th>
                                                <th>Bertemu Dengan</th>
                                                <th>Keperluan</th>
                                                <th>Foto</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- [ basic-table ] end -->
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </section>

    <?php $this->load->view('layout/footer') ?>

</body>
<script type="text/javascript" src="<?php echo base_url('assets/request/guest/guest.js?v=') . time(); ?>"></script>
<script>
	const base_url = "<?= base_url(); ?>";
</script>
</html>