@extends('admin.core.core-dashboard')
@section('extraCSS')
    <link href="{{asset('admin/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection

@section('content')
<div class="row">

    <div class="col-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Form Mitigasi</h6>
            </div>
            <form class="card-body" method="POST" enctype="multipart/form-data" action="{{route('back-laporan-bencana.update', $data->id)}}">
                @csrf
                @method('put')
                <div class="form-group">
                    <label for="title" class="ml-1">Judul :</label>
                    <input type="text" class="form-control  @error('title') is-invalid @enderror" name="title" placeholder="Judul..." value="{{old('title', $data->title)}}" required>
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
                            <option value="{{ $item->id }}" {{ old('kategori', $data->id_kategori_bencana) == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                        @endforeach
                    </select>
                    @error('kategori')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="deskripsi_berita" class="ml-1">Deskripsi :</label>

                    <textarea id="summernotess" name="deskripsi_berita" rows="10" placeholder="Deskripsi....." class="form-control" cols="50" rows="10"  @error('deskripsi_berita') is-invalid @enderror style="white-space: pre-wrap">{{old('deskripsi_berita', $data->deskripsi)}}</textarea>

                    @error('deskripsi_berita')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="longitude" class="ml-1">Longitude :</label>
                    <input type="text" class="form-control  @error('longitude') is-invalid @enderror" name="longitude" placeholder="Longitude..." value="{{old('longitude', $data->longitude)}}" required>
                    @error('longitude')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="latitude" class="ml-1">Latitude :</label>
                    <input type="text" class="form-control  @error('latitude') is-invalid @enderror" name="latitude" placeholder="Latitude..." value="{{old('latitude', $data->latitude)}}" required>
                    @error('latitude')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <p>
                        <img src="{{asset('upload/mitigasi/'.$data->gambar)}}" style="width: 100px;">
                    </p>
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
