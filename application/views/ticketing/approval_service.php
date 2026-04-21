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
                'active_nav' => "Approval",
                'page_header_tittle' => "Approval Page",
                'button_input_data' => "/chargers/input_new_charger",

            );
            $this->load->view('layout/page_content_header', $data)
            ?>
            <!-- [ Main Content ] start -->
            <div class="row">
                <?php
                // $this->load->view('charger/edit_charger_modal') 
                ?>

                <!-- [ basic-table ] start -->
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Approval Service Data</h5>
                        </div>
                        <div class="card-body table-border-style">
                            <div class="table-responsive" id="pc-dt-filter">
                                <section class="table-section">
                                    <table id="tblApproval" class="table table-striped table-bordered nowrap">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>No Request</th>
                                                <th>Nama Karyawan</th>
                                                <th>Kategori</th>
                                                <th>Tanggal Request</th>
                                                <th>Keterangan</th>
                                                <th>Status</th>
                                                <th>Aksi </th>
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
<script type="text/javascript" src="<?php echo base_url('assets/request/ticketing/approval.js?v=') . time(); ?>"></script>


</html>