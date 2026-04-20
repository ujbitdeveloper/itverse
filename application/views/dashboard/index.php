<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('layout/header_style') ?>
<!-- [Body] Start -->

<body data-pc-preset="preset-1" data-pc-direction="ltr" data-pc-theme="light">
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <?php $this->load->view('layout/sidebar') ?>
    <?php $this->load->view('layout/header_dashboard') ?>
    <?php $this->load->view('layout/header_filter') ?>
    <!-- [ Main Content ] start -->
    <div class="pc-container">
        <div class="pc-content">
            <!-- [ breadcrumb ] start -->
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>assets/dashboard/index.html">Home</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0)">Dashboard</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ breadcrumb ] end -->
            <!-- [ Main Content ] start -->
            <div class="row">

            </div>
        </div>
        <?php $this->load->view('layout/footer') ?>

    </div>

    <!-- [Page Specific JS] start -->
    <script src="<?php echo base_url(); ?>assets/style/js/plugins/apexcharts.min.js"></script>
    <!-- Required Js -->
    <script src="<?php echo base_url(); ?>assets/style/js/plugins/popper.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/style/js/plugins/simplebar.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/style/js/fonts/custom-font.js"></script>
    <script src="<?php echo base_url(); ?>assets/style/js/pcoded.js"></script>
    <script src="<?php echo base_url(); ?>assets/style/js/plugins/feather.min.js"></script>



</body>
<!-- [Body] end -->

</html>