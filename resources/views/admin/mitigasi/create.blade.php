@extends('admin.core.core-dashboard')
@section('extraCSS')
    <link href="{{asset('admin/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
    integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
    crossorigin=""/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/css/bootstrap-select.min.css">
    <style>
        #map { height: 600px; }
    </style>
@endsection

@section('content')
<div class="row">

    <div class="col-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Form Mitigasi</h6>
            </div>
            <form class="card-body" method="POST" enctype="multipart/form-data" action="{{route('back-mitigasi.store')}}">
                @csrf
                <div class="form-group">
                    <label for="title" class="ml-1">Judul :</label>
                    <input type="text" class="form-control  @error('title') is-invalid @enderror" name="title" placeholder="Judul..." value="{{old('title')}}" required>
                    @error('title')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="kategori" class="ml-1">Kategori :</label>
                    <select name="kategori" id="kategori" class="form-control @error('kategori') is-invalid @enderror" required>
                        <option value="0">--- Pilih Kategori ---</option>
                        @foreach ($kategori as $item)
                            <option value="{{ $item->id }}" {{ old('kategori') == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                        @endforeach
                    </select>
                    @error('kategori')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                <div class="form-group row">
                   <div class="col-lg-6">
                        <label for="kecamatan" class="ml-1">Kecamatan :</label>
                        {{-- class="selectpicker form-control" data-live-search="true" --}}
                        <select name="kecamatan" id="kecamatan" class="selectpicker form-control @error('kecamatan') is-invalid @enderror" data-live-search="true" required>
                            <option value="0"> --- Pilih kecamatan ---</option>
                            @foreach ($kecamatan as $item)
                                <option value="{{ $item->id }}" {{ old('kecamatan') == $item->id ? 'selected' : '' }}>{{ $item->kecamatan }}</option>
                            @endforeach
                        </select>
                        @error('kecamatan')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                   </div>
                   <div class="col-lg-6">
                    <label for="desa" class="ml-1">Desa :</label>
                    <select name="desa" id="desa" class="selectpicker form-control @error('desa') is-invalid @enderror" data-live-search="true" required>
                        <option value="0"> --- Pilih desa ---</option>
                        @foreach ($desa as $item)
                            <option value="{{ $item->id }}" {{ old('desa') == $item->id ? 'selected' : '' }}>{{ $item->desa }}</option>
                        @endforeach
                    </select>
                    @error('desa')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                   </div>
                </div>
                <div class="form-group">
                    <label for="deskripsi_berita" class="ml-1">Deskripsi :</label>

                    <textarea id="summernotess" name="deskripsi_berita" rows="10" placeholder="Deskripsi....." class="form-control" cols="50" rows="10"  @error('deskripsi_berita') is-invalid @enderror style="white-space: pre-wrap">{{old('deskripsi_berita')}}</textarea>

                    @error('deskripsi_berita')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="longitude" class="ml-1">Longitude :</label>
                            {{-- <p id="labelLongitude">-</p> --}}
                            <input type="text" id="longitude" class="form-control  @error('longitude') is-invalid @enderror" name="longitude" placeholder="longitude..." value="{{old('longitude')}}" readonly>
                            @error('longitude')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="latitude" class="ml-1">Latitude :</label>
                            {{-- <p id="labelLatitude">-</p> --}}
                            <input type="text" id="latitude" class="form-control  @error('latitude') is-invalid @enderror" name="latitude" placeholder="Latitude..." value="{{old('latitude')}}" readonly>
                            @error('latitude')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                {{-- <div class="form-group">
                    <label for="longitude" class="ml-1">Longitude :</label>
                    <input type="text" class="form-control  @error('longitude') is-invalid @enderror" name="longitude" placeholder="Longitude..." value="{{old('longitude')}}" required>
                    @error('longitude')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="latitude" class="ml-1">Latitude :</label>
                    <input type="text" class="form-control  @error('latitude') is-invalid @enderror" name="latitude" placeholder="Latitude..." value="{{old('latitude')}}" required>
                    @error('latitude')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div> --}}
                <div class="form-group">
                    <label for="location" class="ml-1">Pilih Lokasi :</label>
                    <div id="map"></div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="fileImage">Gambar</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="cover" id="inputImage" aria-describedby="fileImage">
                            <label class="custom-file-label" for="inputImage">Choose File...</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary btn-icon-split mt-2 float-right" type="submit">
                        <span class="icon text-white-50">
                            <i class="fas fa-save"></i>
                        </span>
                        <span class="text">Simpan</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('extraJS')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/js/bootstrap-select.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
    {{-- <script src="https://unpkg.com/esri-leaflet@3.0.4/dist/esri-leaflet.js" integrity="sha512-oUArlxr7VpoY7f/dd3ZdUL7FGOvS79nXVVQhxlg6ij4Fhdc4QID43LUFRs7abwHNJ0EYWijiN5LP2ZRR2PY4hQ==" crossorigin=""></script>
    <script src="https://unpkg.com/esri-leaflet-vector@3.1.1/dist/esri-leaflet-vector.js" integrity="sha512-7rLAors9em7cR3583gZSvu1mxwPBUjWjdFJ000pc4Wpu+fq84lXF1l4dbG4ShiPQ4pSBUTb4e9xaO6xtMZIlA==" crossorigin=""></script> --}}

    <script>
        /* var tiles = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
            maxZoom: 10000,
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, ' +
                'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            id: 'mapbox/streets-v11',
            tileSize: 512,
            zoomOffset: -1
        }).addTo(map); */

        /* L.esri.basemapLayer('Oceans').addTo(map); */

        /* Hybrid: s,h;
        Satellite: s;
        Streets: m;
        Terrain: p; */

        var map = L.map('map').setView([-7.93699,113.812946], 13);
        var marker = L.marker([-7.93699,113.812946]).addTo(map);
        var circle = new L.circleMarker();

        L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}',{
            maxZoom: 20,
            minZoom: 10,
            subdomains:['mt0','mt1','mt2','mt3']
        }).addTo(map);


        /* var labelLatVal = document.getElementById('labelLatitude');
        var labelLongVal = document.getElementById('labelLongitude'); */

        var latVal = document.getElementById('latitude');
        var longVal = document.getElementById('longitude');

        map.on('click', function(e) {
            /* labelLatVal.innerHTML = e.latlng.lat;
            labelLongVal.innerHTML = e.latlng.lng; */

            latVal.value = e.latlng.lat;
            longVal.value = e.latlng.lng;

            map.removeLayer(marker)
            map.removeLayer(circle);

            marker = new L.Marker(e.latlng, {draggable:true});
            map.addLayer(marker);

            /* var marker = L.marker([e.latlng.lat, e.latlng.lng]).addTo(map); */
            /* alert("Lat, Lon : " + e.latlng.lat + ", " + e.latlng.lng); */
        });

        /* function setRadius(){
            var rad = document.getElementById('radius').value;

            map.removeLayer(circle);
            circle = new L.circle([latVal.value, longVal.value], {
                color: 'red',
                fillColor: '#f03',
                fillOpacity: 0.5,
                radius: rad
            }).addTo(map);
        } */


    </script>
   <script type="text/javascript">

</script>
@endsection
