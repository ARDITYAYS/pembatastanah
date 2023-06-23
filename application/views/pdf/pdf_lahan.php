<!DOCTYPE html>
<html lang="en">

<head>
    <title>Data Lahan</title>
    <link rel="stylesheet" href="<?= base_url() ?>template/bootstrap4/css/bootstrap.min.css">
</head>

<body>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            font-size: 11px;
        }

        table td,
        table th {
            border: 1px solid #ddd;
            padding: 2px 4px;
        }

        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        table tr:hover {
            background-color: #ddd;
        }

        table th {
            color: #000;
        }
    </style>
    <br>

    <div class="cols text-white" style="margin-left:auto;margin-right:auto">
        <font size="12">
            <center>PEMERINTAH DAERAH KABUPATEN CIREBON
        </font>
        <br>
        <font size="14">BADAN PERTANAHAN NASIONAL</font>
        <br>
        <font size="1">(nama komplek nya kalau ada)</font>
        <br>
        <font size="1">(Alamat Lengkap Jalan sama daerah, No telepon perusahaan)</font>
        <br>
        <font size="1">(Sosial Media maupun Apapun yang bisa di hubungi seperti Email dan lain-lain)</font>
        <br>
        <font size="1">KAB.CIREBON - (KODE POS)</font>
    </div>
    <!--<th><center><img src="" alt="Logo" width="140" height="140"></th>-->


    <hr>
    <br>

    <font size="2"> Laporan Data Lahan : </font>
    <br>
    <br>

    <table align="center" class='table text-white'>
        <thead>
            <tr>
                <th>No</th>
                <th>Pengguna</th>
                <th>Alamat</th>
                <th>Hak</th>
                <th>No Tanah</th>
                <th>Tanggal Hak</th>
                <th>Luas m<sup>2</sup></th>
                <th>Nilai</th>
                <th>Asal</th>
                <th>Jenis Tanah</th>
                <th>Dinas</th>
                <th>Status</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            foreach ($lahan as $key => $value) { ?>
                <tr>
                    <th><?= $no++ ?></th>
                    <th><?= $value->pengguna ?></th>
                    <th style="padding:5px 20px"><?= $value->alamat ?></th>
                    <th><?= $value->hak ?></th>
                    <th><?= $value->no ?></th>
                    <th><?= $value->tglhak ?></th>
                    <th><?= $value->luas ?></th>
                    <th style="padding:5px 20px"><?= $value->nilai ?></th>
                    <th><?= $value->asal ?></th>
                    <th><?= $value->jenis ?></th>
                    <th><?= $value->dinas ?></th>
                    <th><?= $value->status ?></th>
                    <th><?= $value->keterangan ?></th>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <script src="<?= base_url() ?>template/plugins/bootstrap4/js/bootstrap.bundle.min.js"></script>
</body>

</html>