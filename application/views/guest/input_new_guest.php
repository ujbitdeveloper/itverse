<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Form Registrasi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->load->view('layout/header_style') ?>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/style/select2/select2-bootstrap-5-theme.min.css">
    <style>
        :root {
            --secondary: #00bae3;
            --primary: #8de6fa;
            --putih: #ffffff;
        }

        body {
            background: linear-gradient(135deg, #fef6fb, #edfdf5);
            font-family: 'Poppins', sans-serif;
        }

        .card {
            border-radius: 25px;
            border: none;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.08);
            background: white;
        }

        .title {
            font-weight: 600;
            color: #444;
        }

        .form-control {
            border-radius: 12px;
            border: 1px solid #eee;
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.15rem rgba(255, 175, 204, 0.3);
        }

        .btn-main {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border: none;
            border-radius: 15px;
            font-weight: 500;
            padding: 10px;
        }

        .btn-main:hover {
            transform: translateY(-1px);
            opacity: 0.9;
        }

        .section-title {
            font-size: 13px;
            font-weight: 600;
            margin-top: 10px;
            color: #888;
        }

        .icon-circle {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--pink-soft), var(--hijau-soft));
            display: flex;
            align-items: center;
            justify-content: center;
            margin: auto;
            font-size: 24px;
        }
    </style>
</head>

<body>
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-11">
                <div class="card p-4">
                    <?php $this->load->view('layout/notif'); ?>

                    <h4 class="text-center title mt-3">Form Registrasi</h4>
                        <form id="userForm" action="<?php echo site_url('insert_guest') ?>" autocomplete="off" method="post">
                        <div class="mb-3">
                            <label class="form-label">Pilih Kategori</label>
                            <div class="d-flex gap-2">
                                <select name="id_jenis" id="id_jenis" class="form-control">
                                    <option value="">-- Pilih --</option>
                                </select>
                            </div>
                        </div>
                        <div class="section-title">
                            <div class=" mb-3">
                                <label>Nama Lengkap</label>
                                <input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>No Telepon</label>
                                <input type="text" name="no_tlp" id="no_tlp" class="form-control">
                            </div>
                        </div>
                        <div class="section-title">
                            <div class="mb-3">
                                <label>Alamat Lengkap</label>
                                <textarea name="alamat" id="alamat" class="form-control"></textarea>
                            </div>

                            <div class="mb-3">
                                <label>Posisi Lamaran</label>
                                <input type="text" name="posisi" id="posisi" class="form-control">
                            </div>
                        </div>

                        <div class="section-title">
                            <div class="mb-3">
                                <label>Instansi</label>
                                <input type="text" name="instansi" id="instansi" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label>Bertemu Dengan</label>
                                <input type="text" name="tujuan" id="tujuan" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label>Keperluan</label>
                                <input type="text" name="keperluan" id="keperluan" class="form-control">
                            </div>
                        </div>
                       <div class="mb-3">
                        <label>Ambil Foto</label><br><br>

                        <button
                            type="button"
                            class="btn btn-primary mb-2"
                            onclick="startCamera()">
                            Aktifkan Kamera
                        </button>

                        <div id="cameraBox" style="display:none;">

                            <video
                                id="video"
                                width="250"
                                autoplay
                                playsinline
                                muted
                                style="
                                    border-radius:10px;
                                    background:#000;
                                ">
                            </video>

                            <br><br>

                            <button
                                type="button"
                                class="btn btn-success btn-sm"
                                onclick="ambilFoto()">
                                Ambil Foto
                            </button>

                            <button
                                type="button"
                                class="btn btn-danger btn-sm"
                                onclick="stopCamera()">
                                Tutup Kamera
                            </button>

                        </div>

                        <canvas
                            id="canvas"
                            width="250"
                            height="200"
                            style="display:none;">
                        </canvas>

                        <br>

                        <img
                            id="preview"
                            style="
                                margin-top:10px;
                                width:250px;
                                border-radius:10px;
                                display:none;
                            ">

                        <input
                            type="hidden"
                            name="foto_base64"
                            id="foto_base64">
                    </div>

                        <button type="submit" class="btn btn-main w-100 text-white">
                            Simpan
                        </button>

                    </form>


                </div>
            </div>
        </div>
    </div>
  <?php $this->load->view('layout/footer') ?>

<script>

    let stream = null;
    let isStarting = false;

    async function startCamera() {

        if (isStarting) return;

        isStarting = true;

        try {

            stopCamera();

            const video = document.getElementById('video');

            // tampilkan box dulu
            document.getElementById('cameraBox').style.display = 'block';

            // request camera
            stream = await navigator.mediaDevices.getUserMedia({
                video: {
                    facingMode: "user",
                    width: { ideal: 1280 },
                    height: { ideal: 720 }
                },
                audio: false
            });

            video.srcObject = stream;

            // force play
            await video.play();

            console.log("Camera active");

        } catch (err) {

            console.log(err);

            alert(
                "Camera gagal dibuka.\n\n" +
                "Pastikan:\n" +
                "- Izin camera allow\n" +
                "- HTTPS aktif\n" +
                "- Camera tidak dipakai aplikasi lain"
            );

            document.getElementById('cameraBox').style.display = 'none';

        } finally {

            isStarting = false;
        }
    }

    function ambilFoto() {

        const video = document.getElementById('video');
        const canvas = document.getElementById('canvas');

        const context = canvas.getContext('2d');

        // ambil ukuran asli video
        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;

        context.drawImage(
            video,
            0,
            0,
            canvas.width,
            canvas.height
        );

        const dataURL = canvas.toDataURL(
            'image/jpeg',
            0.9
        );

        document.getElementById('preview').src = dataURL;
        document.getElementById('preview').style.display = 'block';

        document.getElementById('foto_base64').value = dataURL;

        stopCamera();
    }

    function stopCamera() {

        if (stream) {

            stream.getTracks().forEach(track => {
                track.stop();
            });

            stream = null;
        }
    }

    // auto restart jika tab balik aktif
    document.addEventListener("visibilitychange", () => {

        if (!document.hidden) {

            const cameraBox =
                document.getElementById('cameraBox');

            if (
                cameraBox.style.display === 'block' &&
                !stream
            ) {
                startCamera();
            }
        }
    });

</script>
    
</body>
<script type="text/javascript" src="<?php echo base_url('assets/request/guest/form_guest.js?v=') . time(); ?>"></script>

</html>