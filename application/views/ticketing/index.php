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
                'master_nav' => "Service Center",
                'active_nav' => "Service",
                'page_header_tittle' => "Service Page",
                'button_input_data' => "insert_service",

            );
            $this->load->view('layout/page_content_header', $data)
            ?>
            <!-- [ Main Content ] start -->
            <div class="row">
                <?php $this->load->view('layout/header_button_input', $data);
                // $this->load->view('charger/edit_charger_modal') 
                ?>

                <!-- [ basic-table ] start -->
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Service Data</h5>
                        </div>
                        <div class="card-body table-border-style">
                            <div class="table-responsive" id="pc-dt-filter">
                                <section class="table-section">
                                    <table id="tblTicketing" class="table table-striped table-bordered nowrap">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>No Request</th>
                                                <th>Kategori</th>
                                                <th>Tanggal Request</th>
                                                <th>Tanggal Selesai</th>
                                                <th>Keterangan Request</th>
                                                <th>Keterangan Pengerjaan</th>
                                                <th>IT Support</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
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
<script type="text/javascript" src="<?php echo base_url('assets/request/ticketing/ticketing.js?v=') . time(); ?>"></script>

</html>