<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/style/css/login.css">
    <?php $this->load->view('layout/header_login') ?>

</head>

<body>
    <!-- Video background -->
    <video autoplay muted loop playsinline class="video">
        <source
            src="<?php echo base_url('./assets/style/videos/ujb-verse2.mp4'); ?>"
            type="video/mp4" />
    </video>
    <div class="overlay"></div>
    <div class="content">
        <div class="container">
            <?php
            $this->load->view('layout/notif'); ?>
            <div class="login-form">
                <div class="title">Login</div>
                <form action="<?php echo site_url('/login/auth') ?>" autocomplete="off" method="post">
                    <div class="input-boxes">
                        <input autocomplete="false" name="hidden" type="text" style="display: none" />
                        <div class="input-box"> <i class="ph ph-users-three"></i>
                            <input type="text" placeholder="Enter your Username" autocomplete="new-password" name="username" id="username" required />
                        </div>
                        <div class="input-box"><i class="ph ph-lock-key"></i><input type="password" placeholder="Enter your password" autocomplete="new-password" name="password" id="password" required />
                        </div>
                        <div class="button input-box">
                            <input type="submit" value="Login" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Get the alert element
        var alertElement = document.getElementById("notif");

        // If the alert exists
        if (alertElement) {
            // Set a timeout to auto close the alert after 5 seconds (5000 milliseconds)
            setTimeout(function() {
                alertElement.style.opacity = "0";
                setTimeout(function() {
                    alertElement.style.display = "none";
                }, 600); // Delay to allow fade out
            }, 5000);
        }
    });
</script>
<script src="https://unpkg.com/phosphor-icons"></script>