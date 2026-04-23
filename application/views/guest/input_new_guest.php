<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Form Registrasi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->load->view('layout/header_style') ?>


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
                    <h4 class="text-center title mt-3">Form Registrasi</h4>

                    <form method="get" action="<?= base_url('guest/form') ?>" novalidate>
                        <div class="mb-3">
                            <label class="form-label">Pilih Kategori</label>
                            <div class="d-flex gap-2">
                                <select name="id_jenis" class="form-control" onchange="pilihJenis(this.value)">
                                    <option value="">-- Pilih --</option>

                                </select>
                            </div>
                        </div>
                    </form>


                    <form method="post" action="<?= base_url('guest/submit') ?>" enctype="multipart/form-data">
                        <input type="hidden" name="id_jenis">
                        <div class=" mb-3">
                            <label>Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control" required>
                        </div>

                        <div class="section-title">
                            <div class="mb-3">
                                <label>Alamat Lengkap</label>
                                <textarea name="alamat" class="form-control" required></textarea>
                            </div>

                            <div class="mb-3">
                                <label>Posisi Lamaran</label>
                                <input type="text" name="posisi" class="form-control" required>
                            </div>
                        </div>

                        <label>No Telepon</label>
                        <input type="text" name="no_tlp" class="form-control" required>

                        <div class="section-title">
                            <div class="mb-3">
                                <label>Instansi</label>
                                <input type="text" name="instansi" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label>Bertemu Dengan</label>
                                <input type="text" name="tujuan" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label>Keperluan</label>
                                <input type="text" name="keperluan" class="form-control" required>
                            </div>
                        </div>
                        <div class="mb-3">

                            <label>Ambil Foto</label><br><br>

                            <button type="button" class="btn btn-primary mb-2" onclick="startCamera()">
                                Aktifkan Kamera
                            </button>

                            <div id="cameraBox" style="display:none;">
                                <video id="video" width="250" autoplay style="border-radius:10px;"></video><br><br>
                                <button type="button" class="btn btn-primary btn-sm" onclick="ambilFoto()">
                                    Ambil Foto
                                </button>
                            </div>

                            <canvas id="canvas" width="250" height="200" style="display:none;"></canvas>
                            <br>
                            <img id="preview" style="margin-top:10px; width:250px; border-radius:10px; display:none;">

                            <input type="hidden" name="foto_base64" id="foto_base64">

                        </div>

                        <button type="submit" class="btn btn-main w-100 text-white">
                            Simpan
                        </button>

                    </form>


                </div>
            </div>
        </div>
    </div>



    <script>
        let stream = null;

        function startCamera() {

            navigator.mediaDevices.getUserMedia({
                    video: true
                })
                .then(s => {
                    stream = s;

                    const video = document.getElementById('video');
                    video.srcObject = stream;

                    document.getElementById('cameraBox').style.display = 'block';
                })
                .catch(err => {
                    alert("Kamera tidak diizinkan / tidak tersedia");
                });
        }

        function ambilFoto() {
            const video = document.getElementById('video');
            const canvas = document.getElementById('canvas');
            const context = canvas.getContext('2d');

            context.drawImage(video, 0, 0, canvas.width, canvas.height);

            const dataURL = canvas.toDataURL('image/jpeg');

            document.getElementById('preview').src = dataURL;
            document.getElementById('preview').style.display = 'block';

            document.getElementById('foto_base64').value = dataURL;

            stopCamera();
        }

        function stopCamera() {
            if (stream) {
                stream.getTracks().forEach(track => track.stop());
            }
        }
    </script>

</body>

</html>