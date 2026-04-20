    <script src="<?php echo base_url(); ?>assets/style/js/plugins/popper.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/style/js/plugins/simplebar.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/style/js/plugins/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/style/js/fonts/custom-font.js"></script>
    <script src="<?php echo base_url(); ?>assets/style/js/pcoded.js"></script>
    <script src="<?php echo base_url(); ?>assets/style/js/plugins/feather.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/style/js/plugins/simple-datatables.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/datatables.net-dt/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">
    <!-- JS: JANGAN pakai jquery.slim.min.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <!-- DataTables core -->
    <script src="https://cdn.jsdelivr.net/npm/datatables.net/js/jquery.dataTables.min.js"></script>
    <!-- Select2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        var app = {
            base_url: '<?php echo base_url() ?>',
            token: {
                <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'
            },
        }
    </script>