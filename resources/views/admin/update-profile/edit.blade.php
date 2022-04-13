@extends('admin.core.core-dashboard')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Perbarui Administrator </h6>
                </div>
                <form class="card-body" method="POST" enctype="multipart/form-data"
                    action="{{ route('update-profile.update',$data->id ) }}">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="name" class="ml-1">Nama :</label>
                        <input type="text" class="form-control  @error('name') is-invalid @enderror" name="name"
                            placeholder="Nama ..." value="{{ $data->name }}">
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email" class="ml-1">Email :</label>
                        <input type="email" class="form-control  @error('email') is-invalid @enderror" name="email"
                            placeholder="Email ..." value="{{ $data->email }}">
                        @error('email')
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
                            <span class="text">Simpan </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

