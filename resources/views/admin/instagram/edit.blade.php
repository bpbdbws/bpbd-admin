@extends('admin.core.core-dashboard')
@section('content')
<div class="row">
    @if (session('status'))
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
    @endif
    <div class="col-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Form Kategori Berita</h6>
            </div>          
            <form class="card-body" method="POST" action="{{url('/back-instagram-embed/update')}}/{{$getDetailInstagram->id}}">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label for="title" class="ml-1">Judul :</label>
                    <input type="text" class="form-control  @error('title') is-invalid @enderror" name="title" placeholder="Judul Instagram ..." value="{{$getDetailInstagram->title}}">
                    @error('title')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="description" class="ml-1">Link Embed :</label>
                    <input type="text" class="form-control  @error('description') is-invalid @enderror" name="description" placeholder="Link Embed..." value="{{$getDetailInstagram->deskripsi}}">
                    @error('description')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <button class="btn btn-primary btn-icon-split mt-2 float-right" type="submit">
                        <span class="icon text-white-50">
                            <i class="fas fa-save"></i>
                        </span>
                        <span class="text">Simpan Embed</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Preview</h6>
            </div> 
            <div class="p-3 m-auto">
                {!! $getDetailInstagram->deskripsi!!}
            </div>        
        </div>
    </div>
</div>
@endsection