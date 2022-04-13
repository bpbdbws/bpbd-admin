@extends('admin.core.core-dashboard')
@section('content')
    <div class="row">
        @if (session('status'))
            <div class="alert alert-success sb-alert-icon m-3 w-100" role="alert">
                <button class="close" type="button" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <div class="sb-alert-icon-content">
                    {{ session('status') }}
                </div>
            </div>
        @elseif (session('error'))
            <div class="alert alert-danger sb-alert-icon m-3 w-100" role="alert">
                <button class="close" type="button" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <div class="sb-alert-icon-content">
                    {{ session('error') }}
                </div>
            </div>
        @endif
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Perbarui Kategori </h6>
                </div>
                <form class="card-body" method="POST" enctype="multipart/form-data"
                    action="{{ url('/back-kategori-bencana/update') }}/{{ $getDetailKategori->id }}">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="title" class="ml-1">Judul :</label>
                        <input type="text" class="form-control  @error('title') is-invalid @enderror" name="title"
                            placeholder="Judul Kategori ..." value="{{ $getDetailKategori->name }}">
                        @error('title')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="title" class="ml-1">Judul :</label>
                        <input type="text" class="form-control  @error('link_embed') is-invalid @enderror" name="link_embed"
                            placeholder="Link Embed ..." value="{{ $getDetailKategori->link_embed }}">
                        @error('link_embed')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="mitigation" class="ml-1">Deskripsi :</label>
                        <textarea id="summernotess" name="mitigation" rows="10" placeholder="Deskripsi..."
                            class="form-control" cols="50" rows="10" @error('mitigation') is-invalid @enderror
                            style="white-space: pre-wrap">{{ $getDetailKategori->mitigasi }}</textarea>

                    </div>
                    @error('mitigation')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="row">
                        <div class="col-3">
                            <div class="form-group text-center">
                                <img id="preview" src="{{ asset('upload/kategori/' . $getDetailKategori->icon) }}"
                                    class="img-thumbnail" alt="...">
                            </div>
                        </div>
                        <div class="col-9">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="fileImage">Icon Kategori</span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="icon" id="inputImage"
                                            aria-describedby="fileImage">
                                        <label class="custom-file-label" for="inputImage">Choose File...</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3">
                            <div class="form-group text-center">
                                <img id="preview" src="{{ asset('upload/kategori/' . $getDetailKategori->photos) }}"
                                    class="img-thumbnail" alt="...">
                            </div>
                        </div>
                        <div class="col-9">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="fileImage">Foto Peta KRB</span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="photos" id="inputImage"
                                            aria-describedby="fileImage">
                                        <label class="custom-file-label" for="inputImage">Choose File...</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary btn-icon-split mt-2 float-right" type="submit">
                            <span class="icon text-white-50">
                                <i class="fas fa-save"></i>
                            </span>
                            <span class="text">Simpan </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('extraJS')
    <script type="text/javascript">
        inputImage.onchange = evt => {
            const [file] = inputImage.files
            if (file) {
                preview.src = URL.createObjectURL(file)
            }
        }
    </script>
@endsection
