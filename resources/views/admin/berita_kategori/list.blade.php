@extends('admin.core.core-dashboard')
@section('extraCSS')
    <link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="row">
        {{-- @if (session('status'))
        <div class="alert alert-success sb-alert-icon m-3 w-100" role="alert">
            <button class="close" type="button" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <div class="sb-alert-icon-content">
                {{session('status')}}
            </div>
        </div>
    @elseif (session('error'))
        <div class="alert alert-danger sb-alert-icon m-3 w-100" role="alert">
            <button class="close" type="button" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <div class="sb-alert-icon-content">
                {{session('error')}}
            </div>
        </div>
    @endif --}}
</div>
<div class="row">
    <div class="col-12">
        <a href="{{ url('/back-kategori-bencana/create') }}">
            <button class="btn btn-sm btn-primary mb-2">Tambah Data</button>
        </a>
        <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">List Kategori</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered thisDisplay" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>
                                        <center>No.</center>
                                    </th>
                                    <th>
                                        <center>Judul</center>
                                    </th>
                                    <th class="w-50">
                                        <center>Deskripsi</center>
                                    </th>
                                    <th>
                                        <center>Icon</center>
                                    </th>
                                    <th>
                                        <center>Foto Peta KRB</center>
                                    </th>
                                    <th>
                                        <center>Opsi</center>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($listKategori as $item)
                                    <tr>
                                        <td class="align-middle">
                                            <center>{{ $loop->iteration }}</center>
                                        </td>
                                        <td class="align-middle">
                                            <center>{{ $item->name }}</center>
                                        </td>
                                        <td class="align-middle">
                                            {{-- <center>{!! Str::limit($item->mitigasi, $limit = 50, $end = '...') !!}</center> --}}
                                            {!! $item->mitigasi !!}
                                        </td>
                                        <td class="align-middle">
                                            <center><img src="{{ asset('upload/kategori/' . $item->icon) }}"
                                                    style="width: 100px;"></center>
                                        </td>
                                        <td class="align-middle">
                                            <center><img src="{{ asset('upload/kategori/' . $item->photos) }}"
                                                    style="width: 100px;"></center>
                                        </td>
                                        <td class="align-middle">
                                            <center>
                                                <form
                                                    action="{{ url('/back-kategori-bencana') }}/{{ $item->id }}/edit"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-info btn-circle">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </button>
                                                </form>
                                                |
                                                <form
                                                    action="{{ url('/back-kategori-bencana') }}/{{ $item->id }}/drop"
                                                    method="POST" class="d-inline">
                                                    @method('delete')
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-danger btn-circle"
                                                        onclick="return confirm('Hapus Data ?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </center>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('extraJS')
    <script src="{{ asset('admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#dataTable').DataTable();
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
