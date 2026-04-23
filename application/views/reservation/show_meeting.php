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
                <div class="room">RUANGAN MEETING BESAR</div>
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
        const roomId = <?= $id_ruangan ?>;
    </script>
    <script>
        function updateClock() {
            const now = new Date();
            const time = now.toLocaleTimeString("en-US", {
                hour: "2-digit",
                minute: "2-digit",
                second: "2-digit",
                hour12: true,
                timeZone: "Asia/Jakarta",
            });
            const date = now.toLocaleDateString("en-US", {
                weekday: "long",
                day: "2-digit",
                month: "long",
                year: "numeric",
                timeZone: "Asia/Jakarta",
            });
            document.getElementById("clock").textContent = time;
            document.getElementById("date").textContent = date;
        }

        function startClock() {
            updateClock();
            setInterval(updateClock, 1000);
        }
        startClock();
        setInterval(() => {
            location.reload();
        }, 1000000);
    </script>

    <script>
        async function loadMeeting() {
            try {
                const res = await fetch(`<?= base_url('get_meeting_api/') ?>${roomId}`);
                const data = await res.json();

                if (!data.status) return;

                const list = data.list_meeting;
                const current = data.current_meeting;

                // 🔥 HEADER ROOM
                document.getElementById("roomName").textContent =
                    list.length ? list[0].nama_ruangan : "RUANGAN";

                // 🔥 CURRENT MEETING
                document.getElementById("meetingTitle").textContent =
                    current ? current.keterangan : "TIDAK ADA MEETING";

                document.getElementById("meetingTime").textContent =
                    current ? `${current.jam_mulai} - ${current.jam_selesai}` : "-";

                document.getElementById("meetingStatus").textContent =
                    current ? "IN MEETING" : "KOSONG";

                document.getElementById("meetingBy").textContent =
                    current ? current.nama : "-";

                // 🔥 LIST MEETING
                const container = document.getElementById("meetingList");
                container.innerHTML = "";

                const now = new Date().toLocaleTimeString('en-GB', {
                    hour12: false,
                    timeZone: "Asia/Jakarta"
                });

                list.forEach(m => {
                    let st_txt = "";
                    let st_cls = "";

                    if (now < m.jam_mulai) {
                        st_txt = "UPCOMING";
                        st_cls = "upcoming";
                    } else if (now >= m.jam_mulai && now <= m.jam_selesai) {
                        st_txt = "IN PROGRESS";
                        st_cls = "in-progress";
                    } else {
                        st_txt = "ENDED";
                        st_cls = "ended";
                    }

                    const card = `
                <div class="card ${st_cls} ${st_cls === 'in-progress' ? 'active' : ''}">
                    <div class="card-header-status">
                        <h3>${m.keterangan}</h3>
                        <span class="badge">${st_txt}</span>
                    </div>
                    <p>
                        ${m.jam_mulai} - ${m.jam_selesai} | ${m.nama}
                    </p>
                </div>
            `;

                    container.innerHTML += card;
                });

            } catch (err) {
                console.error(err);
            }
        }

        // 🔥 AUTO REFRESH TANPA RELOAD
        setInterval(loadMeeting, 5000);

        // 🔥 FIRST LOAD
        loadMeeting();
    </script>

</body>

</html>