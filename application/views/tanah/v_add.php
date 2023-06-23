<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
    <div class="card mb-3">
        <div class="row g-0">
            <div class="col-sm-7">
                <!--peta-->
                <div id="map" style="width: 100%; height: 550px;"></div>
                <!--akhir peta-->
            </div>
            <div class="col-sm-5">
                <?php

                echo validation_errors('<div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <i class="icon fas fa-ban"></i>', '</div>');

                if (isset($error_upload)) {
                    echo '<div class="alert alert-warning alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <i class="icon fas fa-exclamation-triangle"></i>' . $error_upload . '</div>';
                }

                if ($this->session->flashdata('sukses')) {
                    echo '<div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <i class="icon fas fa-check"></i>';
                    echo $this->session->flashdata('sukses');
                    echo '</div>';
                }

                echo form_open_multipart('dtanah/add'); ?>

                <div class="form-group">
                    <label>Nama Pengguna</label>
                    <input type="text" name="pengguna" value="<?= set_value('pengguna') ?>" class="form-control" placeholder="Nama Pengguna">
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <textarea name="alamat" class="form-control"></textarea>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Hak</label>
                            <input type="text" value="<?= set_value('hak') ?>" name="hak" class="form-control" placeholder="Hak">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>No. Tanah</label>
                            <input type="text" value="<?= set_value('no') ?>" name="no" class="form-control" placeholder="No">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Tanggal Hak</label>
                            <input type="date" name="tglhak" class="form-control" placeholder="Tanggal Hak">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Luas m</label><sup>2</sup>
                            <input type="text" value="<?= set_value('luas') ?>" name="luas" class="form-control" placeholder="Luas">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Nilai</label>
                            <input type="text" value="<?= set_value('nilai') ?>" name="nilai" class="form-control" placeholder="Nilai">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Asal Tanah</label>
                            <input type="text" value="<?= set_value('asal') ?>" name="asal" class="form-control" placeholder="Asal Tanah">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Jenis Tanah</label>
                            <input type="text" name="jenis" id="jenis_tanah" class="form-control" placeholder="Jenis Tanah">
                            <!--<select name="asal" class="form-control">
                            </select>
                                -->
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Asal Dinas</label>
                            <input type="text" value="<?= set_value('dinas') ?>" name="dinas" class="form-control" placeholder="Asal Dinas">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <option value="aktif">Aktif</option>
                        <option value="tidakaktif">Tidak Aktif</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Keterangan</label>
                    <textarea name="keterangan" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label>Denah</label>
                    <textarea name="denah_geojson" rows="6" class="form-control"></textarea>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Warna</label>
                            <div class="input-group my-colorpicker2">
                                <input type="text" name="warna" class="form-control">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-square"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Gambar</label>
                            <input type="file" name="gambar" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="reset" class="btn btn-warning">Reset</button>
                </div>
            </div>

        </div>

    </div>
    <?php echo form_close(); ?>
</div>
</div>
</div>
</div>

</div>
</div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<script>
    var peta1 = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
            '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
            'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        id: 'mapbox/streets-v11'
    });


    var peta2 = L.tileLayer('http://www.google.cn/maps/vt?lyrs=s@189&gl=cn&x={x}&y={y}&z={z}', {
        attribution: 'google'
    });

    var peta3 = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    });

    var map = L.map('map', {
        center: [-6.721887, 108.571338],
        zoom: 16,
        layers: [peta2]
    });

    var baseLayers = {
        'Grayscale': peta1,
        'Satelite': peta2,
        'Streets': peta3
    };

    var overlays = {};

    var layerControl = L.control.layers(baseLayers).addTo(map);


    // FeatureGroup is to store editable layers
    var drawnItems = new L.FeatureGroup();
    map.addLayer(drawnItems);
    var drawControl = new L.Control.Draw({
        draw: {
            polygon: true,
            marker: true,
            circle: false,
            circlemarker: false,
            rectangle: false,
            polyline: true
        },
        edit: {
            featureGroup: drawnItems
        }
    });
    map.addControl(drawControl);

    map.on('draw:created', function(event) {
        var layer = event.layer;
        var feature = layer.feature = layer.feature || {};
        feature.type = feature.type || "Feature";
        var props = feature.properties = feature.properties || {};
        drawnItems.addLayer(layer);
        $("[name=denah_geojson]").html(JSON.stringify(drawnItems.toGeoJSON()))
    });

    map.on('draw:edited', function(e) {
        $("[name=denah_geojson]").html(JSON.stringify(drawnItems.toGeoJSON()))
    });

    map.on('draw:deleted', function(e) {
        $("[name=denah_geojson]").html(JSON.stringify(drawnItems.toGeoJSON()))
    });
</script>

<script>
    $(function() {

        //color picker with addon
        $('.my-colorpicker2').colorpicker()

        $('.my-colorpicker2').on('colorpickerChange', function(event) {
            $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
        });

    })
</script>
<!-- daterange picker -->
<link rel="stylesheet" href="<?= base_url('assets/') ?>vendor/template/plugins/daterangepicker/daterangepicker.css">
<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="<?= base_url('assets/') ?>vendor/template/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
<!-- Bootstrap Color Picker -->
<link rel="stylesheet" href="<?= base_url('assets/') ?>vendor/template/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
<!-- Tempusdominus Bbootstrap 4 -->
<link rel="stylesheet" href="<?= base_url('assets/') ?>vendor/template/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">


<!-- date-range-picker -->
<script src="<?= base_url('assets/') ?>vendor/template./plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap color picker -->
<script src="<?= base_url('assets/') ?>vendor/template/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>