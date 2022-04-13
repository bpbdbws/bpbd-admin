@extends('admin.core.core-dashboard')
@section('extraCSS')
    <link href="{{asset('admin/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="btn-group">
            <a href="{{ route('back-mitigasi.create') }}" class="mb-3 mr-2">
                <button class="btn btn-sm btn-primary">Tambah</button>
            </a>
            <a href="{{ route('back-mitigasi.export') }}" class="mb-3 mr-2" target="_blank">
                <button type="button" class="btn btn-sm btn-info mb-3">
                    <i class="fas fa-file-excel mr-1"></i>Export Excel
                </button>
            </a>
        </div>
        <div class="card shadow mt-2 mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">List Mitigasi</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered thisDisplay" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th><center>No.</center></th>
                                <th><center>Judul</center></th>
                                <th><center>Kategori</center></th>
                                <th><center>Kecamatan</center></th>
                                <th class="w-50"><center>Deskripsi</center></th>
                                <th><center>Gambar</center></th>
                                <th><center>Opsi</center></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                            <tr>
                                <td class="align-middle"><center>{{$loop->iteration}}</center></td>
                                <td class="align-middle"><center>{{$item->title}}</center></td>
                                <td class="align-middle"><center>{{$item->kategori}}</center></td>
                                <td class="align-middle"><center>{{$item->kecamatan}}</center></td>
                                <td class="align-middle"><center>{!! $item->deskripsi !!}</center></td>
                                <td class="align-middle"><center><img src="{{asset('upload/mitigasi/'.$item->gambar)}}" style="width: 100px;"></center></td>
                                <td class="align-middle"><center>
                                    <a href="{{ route('back-mitigasi.edit', $item->id) }}">
                                        <button type="button" class="btn btn-sm btn-info btn-circle">
                                            <i class="fas fa-pencil-alt"></i>
                                        </button>
                                    </a>
                                    |
                                    <form action="{{ route('back-mitigasi.destroy', $item->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-sm btn-danger btn-circle" onclick="return confirm('Hapus Data ?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </center></td>
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
<script src="{{asset('admin/vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script type="text/javascript">
    $(document).ready( function () {
        $('#dataTable').DataTable();
    });
</script>

@endsection
