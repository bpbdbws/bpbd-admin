@extends('admin.core.core-dashboard')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Laporan </h6>
                </div>
                <form class="card-body" method="POST" enctype="multipart/form-data"
                    action="{{ route('back-laporan.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="title" class="ml-1">Judul :</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                            placeholder="Judul Laporan..." value="{{ old('title') }}">
                        @error('title')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="fileFile">File</span>
                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input @error('file') is-invalid @enderror" name="file" id="inputFile"
                                    aria-describedby="fileFile">
                                <label class="custom-file-label" for="inputFile">Choose File...</label>
                            </div>
                        </div>
                        @error('file')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
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
    <script type="text/javascript">
        inputFile.onchange = evt => {
            const [file] = inputImage.files
            if (file) {
                preview.src = URL.createObjectURL(file)
            }
        }
        $(document).ready(function() {
            $('#summernotess').summernote({
                callbacks: {
                    onPaste: function (e) {
                        var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');

                        e.preventDefault();

                        // Firefox fix
                        setTimeout(function () {
                            document.execCommand('insertText', false, bufferText);
                        }, 10);
                    }
                }
            });
        });
    </script>

@endsection
