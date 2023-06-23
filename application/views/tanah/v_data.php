<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
    <div class="card mb-3">
        <div class="row g-0">
            <?php
            if ($this->session->flashdata('sukses')) {
                echo '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <i class="icon fas fa-check"></i>';
                echo $this->session->flashdata('sukses');
                echo '
            </div>';
            }
            ?>

            <br>
            <br>
            <table class="table table-bordered text-sm" id="example1">
                <thead class="text-center">
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
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($lahan as $key => $value) { ?>
                        <tr>
                            <th><?= $no++ ?></th>
                            <th><?= $value->pengguna ?></th>
                            <th><?= $value->alamat ?></th>
                            <th><?= $value->hak ?></th>
                            <th><?= $value->no ?></th>
                            <th><?= $value->tglhak ?></th>
                            <th><?= $value->luas ?></th>
                            <th><?= $value->nilai ?></th>
                            <th><?= $value->asal ?></th>
                            <th><?= $value->jenis ?></th>
                            <th><?= $value->dinas ?></th>
                            <th><?= $value->status ?></th>
                            <th><?= $value->keterangan ?></th>
                            <th class="text-center">
                                <a href="<?= base_url('dtanah/edit/' . $value->id_lahan) ?>" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                <a href="<?= base_url('dtanah/delete/' . $value->id_lahan) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Data akan dihapus apakah yakin ingin menghapus data?')"><i class="fas fa-trash"></i></a>
                            </th>
                        </tr>

                    <?php } ?>
                </tbody>
            </table>
            <a href="<?php echo base_url('dtanah/pdf') ?>" class="btn btn-primary">Print</a>
        </div>
    </div>
</div>
</div>
<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "autoWidth": false,
        });
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>
</div>
</div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->