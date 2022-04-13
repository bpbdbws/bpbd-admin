@extends('admin.core.core-dashboard')
@section('extraCSS')
    <link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow mt-2 mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">List Laporan Bencana</h6>
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
                                    {{-- <th>
                                        <center>Kategori</center>
                                    </th> --}}
                                    <th class="w-50">
                                        <center>Deskripsi</center>
                                    </th>
                                    <th>
                                        <center>Status</center>
                                    </th>
                                    <th>
                                        <center>User</center>
                                    </th>
                                    <th>
                                        <center>Admin</center>
                                    </th>
                                    <th>
                                        <center>Ditolak pada</center>
                                    </th>
                                    <th>
                                        <center>Opsi</center>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td class="align-middle">
                                            <center>{{ $loop->iteration }}</center>
                                        </td>
                                        <td class="align-middle">
                                            <center>{{ $item->title }}
                                                <img src="{{ asset('upload/mitigasi/' . $item->gambar) }}"
                                                    style="width: 100px;">
                                            </center>
                                        </td>
                                        {{-- <td class="align-middle">
                                            <center>{{ $item->kategori }}</center>
                                        </td> --}}
                                        <td class="align-middle">
                                            <center>{!! isset($item->deskripsi) ? Str::limit($item->deskripsi, $limit = 50, $end = '...') : '-' !!}</center>
                                        </td>
                                        <td class="align-middle">
                                            <center>{{ $item->status }}</center>
                                        </td>
                                        <td class="align-middle">
                                            <center>{{ $item->user }}</center>
                                        </td>
                                        <td class="align-middle">
                                            <center>{{ isset($item->admin) ? $item->admin : '-' }}</center>
                                        </td>
                                        <td class="align-middle">
                                            <center>{{ $item->updated_at }}</center>
                                        </td>
                                        <td class="align-middle">
                                            <center>
                                                @if ($item->status == 'pending')
                                                    <a href="{{ route('back-laporan-bencana.edit', $item->id) }}">
                                                        <button type="button" class="btn btn-sm btn-success">Terima</button>
                                                    </a>
                                                    |
                                                    <form action="{{ route('back-laporan-bencana.destroy', $item->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn btn-sm btn-danger"
                                                            onclick="return confirm('Tolak laporan ?')">Tolak</button>
                                                    </form>
                                                @else
                                                    -
                                                @endif
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
        });
    </script>
@endsection
