@extends('admin.core.core-dashboard')
@section('extraCSS')
    <link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="row">

        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Berita</h6>
                </div>
                <form class="card-body" method="POST" enctype="multipart/form-data"
                    action="{{ route('back-berita.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="title" class="ml-1">Judul Berita :</label>
                        <input type="text" class="form-control  @error('title') is-invalid @enderror" name="title"
                            placeholder="Judul Berita..." value="{{ old('title') }}" required>
                        @error('title')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="kategori" class="ml-1">Kategori :</label>
                        <select name="kategori" id="kategori" class="form-control @error('kategori') is-invalid @enderror"
                            required>
                            <option value="0">--- Pilih Kategori ---</option>
                            @foreach ($kategori as $item)
                                <option value="{{ $item->id }}" {{ old('kategori') == $item->id ? 'selected' : '' }}>
                                    {{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('kategori')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="link" class="ml-1">Link Artikel :</label>
                        <input type="text" class="form-control  @error('link') is-invalid @enderror" name="link"
                            placeholder="Link artikel..." value="{{ old('link') }}" required>
                        @error('link')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    {{-- <div class="form-group">
                        <label for="deskripsi_berita" class="ml-1">Deskripsi Berita :</label>

                        <textarea id="summernotess" name="deskripsi_berita" rows="10" placeholder="Deskripsi Berita....."
                            class="form-control" cols="50" rows="10" @error('deskripsi_berita') is-invalid @enderror
                            style="white-space: pre-wrap">{{ old('deskripsi_berita') }}</textarea>

                        @error('deskripsi_berita')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div> --}}
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="fileImage">Gambar Berita</span>
                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="cover" id="inputImage"
                                    aria-describedby="fileImage">
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
