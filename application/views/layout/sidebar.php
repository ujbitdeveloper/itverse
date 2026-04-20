    <!-- [ Sidebar Menu ] start -->
    <nav class="pc-sidebar">
        <div class="navbar-wrapper">
            <div class="m-header">
                <a href="<?php echo site_url('/dashboard'); ?>" class="b-brand text-primary">
                    <img src="<?php echo base_url(); ?>assets/style/images/logobiru.png" class="img-logo-header" alt="logo">
                    <span class="m-header-text">UJB IT</span>
                </a>
            </div>
            <div class="navbar-content">
                <ul class="pc-navbar">
                    <li class="pc-item">
                        <a href="<?php echo site_url('/dashboard'); ?>" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-smart-home"></i></span>
                            <span class="pc-mtext">Dashboard</span>
                        </a>
                    </li>

                    <li class="pc-item pc-caption">
                        <label>Reservation Rooms Meeting</label>
                        <i class="ti ti-dashboard"></i>
                    </li>
                    <li class="pc-item">
                        <a href="<?php echo site_url('reservation'); ?>" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-accessible"></i></span>
                            <span class=" pc-mtext">Reservation</span>
                        </a>
                    </li>

                    <li class="pc-item pc-caption">
                        <label>Service Center</label>
                        <i class="ti ti-dashboard"></i>
                    </li>
                    <li class="pc-item">
                        <a href="<?php echo site_url('service'); ?>" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-devices-pc"></i></span>
                            <span class="pc-mtext">Service</span>
                        </a>
                    </li>
                    <li class="pc-item">
                        <a href="<?php echo site_url('service/approval'); ?>" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-man"></i></span>
                            <span class="pc-mtext">Approval</span>
                        </a>
                    </li>
                    <li class="pc-item">

                        <a href="<?php echo site_url('service/history_service'); ?>" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-history"></i></span>
                            <span class="pc-mtext">History Services</span>
                        </a>
                    </li>

                    <li class="pc-item pc-caption">
                        <label>Guest Book</label>
                        <i class="ti ti-dashboard"></i>
                    </li>
                    <li class="pc-item">
                        <a href="<?php echo site_url('guest'); ?>" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-users"></i></span>
                            <span class="pc-mtext">List Guest</span>
                        </a>
                    </li>

                </ul>

            </div>
        </div>
    </nav>
    <!-- [ Sidebar Menu ] end --> <!-- [ Header Topbar ] start -->