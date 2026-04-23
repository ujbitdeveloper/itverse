<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/style/mycss/style.css" id="main-style-link">
    <title>Meeting Room Display</title>
</head>

<body>
    <div class="container">

        <div class="left">
            <div class="header">
                <div class="logo">

                    <img src="<?php echo base_url(); ?>assets/style/images/ujb.png ?>" alt="logo" />
                </div>
                <div class="room" id="roomHeader">RUANGAN MEETING BESAR</div>
            </div>

            <div class="main">
                <div class="room" id="roomName">RUANGAN</div>

                <h1 id="meetingTitle">TIDAK ADA MEETING</h1>
                <div class="time" id="meetingTime">-</div>
                <div class="status" id="meetingStatus">KOSONG</div>
                <div class="booked">
                    BOOKED BY <span id="meetingBy">-</span>
                </div>
            </div>
        </div>

        <div class="right">
            <div class="clock-box">
                <h2 id="clock">--:--</h2>
                <p id="date">Loading...</p>
            </div>

            <div class="meeting-list">
                <div class="meeting-list" id="meetingList"></div>
            </div>
        </div>

    </div>
    <script>
        const BASE_URL = "<?= base_url() ?>";
        const roomId = <?= $id_ruangan ?>;
    </script>

    <script src="<?= base_url('assets/request/reservation/show_meeting.js?v=') . time(); ?>"></script>



</body>

</html>