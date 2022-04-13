@extends('admin.core.core-dashboard')
@section('content')
<div class="row">
    <div class="col-lg-3">
        <div class="card">
            <div class="card-body">
                <div class="text-center row-auto mt-4">
                    <span><strong> Data Mitigasi Bencana</strong></span>
                    <h1 class="text-info mt-3"> <strong>{{ $dataBencana }} </strong></h1>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="card">
            <div class="card-body">
                <div class="text-center row-auto mt-4">
                    <span><strong> Data Kategori Bencana</strong></span>
                    <h1 class="text-info mt-3"> <strong>{{ $dataKategori }} </strong></h1>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="card">
            <div class="card-body">
                <div class="text-center row-auto mt-4">
                    <span><strong> Data Berita Bencana</strong></span>
                    <h1 class="text-info mt-3"> <strong>{{ $dataBerita }} </strong></h1>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="card">
            <div class="card-body">
                <div class="text-center row-auto mt-4">
                    <span><strong>Total Visitor</strong></span>
                    <h1 class="text-info mt-3"> <strong>{{ $dataVisitor }} </strong></h1>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
