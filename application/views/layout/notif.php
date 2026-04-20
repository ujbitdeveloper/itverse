<style>
    .alert {
        padding: 15px;
        border-radius: 4px;
        position: relative;
        width: 100%;
    }

    .alert-success {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    .alert-danger {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }

    .alert .text {
        font-weight: bold;
    }

    .alert .close-btn {
        position: absolute;
        top: 10px;
        right: 10px;
        cursor: pointer;
        font-size: 20px;
        color: inherit;
    }
</style>
<?php
$message = $this->session->flashdata('notif');
if ($message == 'berhasilInsert') {
?>
    <div id="notif" class="alert alert-success" style="margin-top: 3px">
        <div class="text"><i class="fa fa-check"></i> Berhasil Tambah Data</div>
    </div>
    <br>
<?php } elseif ($message == 'GagalInsert') { ?>
    <div id="notif" class="alert alert-danger" style="margin-top: 3px">
        <div class="text">Gagal Tambah Data</div>
    </div>
    <br>
<?php } elseif ($message == 'Logout') { ?>
    <div id="notif" class="alert alert-success" style="margin-top: 3px">
        <div class="text"><i class="fa fa-check"></i> Anda telah Logout dari sistem</div>
    </div>
    <br>
<?php } elseif ($message == 'GagalLogin') { ?>
    <div id="notif" class="alert alert-danger" style="margin-top: 3px">
        <div class="text">Username atau Password Anda salah</div>
    </div>
    <br>
<?php } elseif ($message == 'Retype') { ?>
    <div id="notif" class="alert alert-danger" style="margin-top: 3px">
        <div class="text">Retype Password salah</div>
    </div>
    <br>
<?php } elseif ($message == 'berhasilUpdate') { ?>
    <div id="notif" class="alert alert-success" style="margin-top: 3px">
        <div class="text"><i class="fa fa-check"></i> Berhasil Edit Data</div>
    </div>
    <br>
<?php } elseif ($message == 'GagalUpdate') { ?>
    <div id="notif" class="alert alert-danger" style="margin-top: 3px">
        <div class="text">Gagal Edit Data</div>
    </div>
    <br>
<?php } elseif ($message == 'berhasilReset') { ?>
    <div id="notif" class="alert alert-success" style="margin-top: 3px">
        <div class="text"><i class="fa fa-check"></i> Reset Password Success, Default Password is 1234</div>
    </div>
    <br>
<?php } elseif ($message == 'GagalReset') { ?>
    <div id="notif" class="alert alert-danger" style="margin-top: 3px">
        <div class="text"> Reset Password Failed</div>
    </div>
    <br>
<?php } elseif ($message == 'updatePassword') { ?>
    <div id="notif" class="alert alert-success" style="margin-top: 3px">
        <div class="text"><i class="fa fa-check"></i> Reset Password Success</div>
    </div>
    <br>
<?php } elseif ($message == 'berhasilActive') { ?>
    <div id="notif" class="alert alert-success" style="margin-top: 3px">
        <div class="text"><i class="fa fa-check"></i> Non Active Success</div>
    </div>
    <br>
<?php } elseif ($message == 'berhasilInsertDataOffline') { ?>
    <div id="notif" class="alert alert-success" style="margin-top: 3px">
        <div class="text"><i class="fa fa-check"></i> Insert Data Batch Success</div>
    </div>
    <br>
<?php } elseif ($message == 'GagalActive') { ?>
    <div id="notif" class="alert alert-danger" style="margin-top: 3px">
        <div class="text"> Non Active Failed</div>
    </div>
    <br>
<?php } elseif ($message == 'dataDuplicate') { ?>
    <div id="notif" class="alert alert-danger" style="margin-top: 3px">
        <div class="text"> Data is Duplicate</div>
    </div>
    <br>
<?php } elseif ($message == 'usernameDuplicate') { ?>
    <div id="notif" class="alert alert-danger" style="margin-top: 3px">
        <div class="text"> Username is Duplicate</div>
    </div>
    <br>
<?php } elseif ($message == 'gagalInsertDataOffline') { ?>
    <div id="notif" class="alert alert-danger" style="margin-top: 3px">
        <div class="text">Insert Batch Data Failed</div>
    </div>
    <br>
<?php } elseif ($message == 'gagalMengunggahFile') { ?>
    <div id="notif" class="alert alert-danger" style="margin-top: 3px">
        <div class="text">Insert Batch Data Failed</div>
    </div>
    <br>
<?php } elseif ($message == 'fileUnggahKosong') { ?>
    <div id="notif" class="alert alert-danger" style="margin-top: 3px">
        <div class="text">Failed open File</div>
    </div>
    <br>
<?php } elseif ($message == 'fileUnggahKosong') { ?>
    <div id="notif" class="alert alert-danger" style="margin-top: 3px">
        <div class="text">Failed open File</div>
    </div>
    <br>
<?php } elseif ($message == 'hanyaText') { ?>
    <div id="notif" class="alert alert-danger" style="margin-top: 3px">
        <div class="text">Just Accept .txt, please check your file</div>
    </div>
    <br>
<?php } elseif ($message == 'formatKeySalah') { ?>
    <div id="notif" class="alert alert-success" style="margin-top: 3px">
        <div class="text"><i class="fa fa-check"></i> Key Not Valid</div>
    </div>
    <br>
<?php } ?>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var alertElement = document.getElementById('notif');

        if (alertElement) {
            setTimeout(function() {
                alertElement.style.opacity = '0';
                setTimeout(function() {
                    alertElement.style.display = 'none';
                }, 600);
            }, 5000);
        }
    });
</script>