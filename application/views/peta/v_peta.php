<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
    <div class="card mb-3">
        <div class="row g-0">
            <div id="map" style="width: 100%; height: 550px;"></div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<script>
    var denah = L.layerGroup();
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
        zoom: 15,
        layers: [peta2, denah]
    });

    var baseLayers = {
        'Grayscale': peta1,
        'Satelite': peta2,
        'Streets': peta3
    };

    var overlays = {
        "Tanah": denah
    };

    var layerControl = L.control.layers(baseLayers, overlays).addTo(map);
    <?php foreach ($lahan as $key => $value) { ?>
        var lahan = L.geoJSON(<?= $value->denah_geojson; ?>, {
            style: {
                color: '<?= $value->warna ?>'
            }
        }).addTo(denah);
        lahan.eachLayer(function(layer) {
            layer.bindPopup("<p>" +
                "<img src='<?= base_url('gambar/' . $value->gambar) ?>' width='200px'></br>" +
                "Pengguna : <?= $value->pengguna ?></br>" +
                "Alamat   : <?= $value->alamat ?></br>" +
                "No       : <?= $value->no ?></br>" +
                "Luas     : <?= $value->luas ?></br></br>" +
                "<a href='<?= base_url('dtanah') ?>'class='btn btn-sm btn-success btn-block' >Rincian</a>" +
                "</P>");
        });
    <?php } ?>
</script>