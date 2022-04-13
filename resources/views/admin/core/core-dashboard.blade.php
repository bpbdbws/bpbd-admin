<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>BPBD Admin</title>
        <link rel="stylesheet" href="{{asset('Summernote/summernote.css')}}">


        <!-- Custom fonts for this template-->
        <link href="{{asset('admin/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

        <!-- Custom styles for this template-->
        <link href="{{asset('admin/css/sb-admin-2.css')}}" rel="stylesheet">
        <link rel="shortcut icon" href="{{asset('image/logo/logo.svg')}}" type="image/x-icon">

        @yield('extraCSS')
    </head>
    <body id="page-top">
        <div id="wrapper">
            @include('admin.components.sidebar')
            <div id="content-wrapper" class="d-flex flex-column">
                <div id="content">
                    @include('admin.components.navbar')
                    <div class="container-fluid">
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
                        @yield('content')
                    </div>
                </div>
            @include('admin.components.footer')
            </div>
        </div>
        @include('admin.components.goTop')
        @include('admin.components.modalLogout')
        
        <!-- Bootstrap core JavaScript-->
        <script src="{{asset('admin/vendor/jquery/jquery.min.js')}}"></script>
        <script src="{{asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

        <!-- Core plugin JavaScript-->
        <script src="{{asset('admin/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

        <!-- Custom scripts for all pages-->
        <script src="{{asset('admin/js/sb-admin-2.min.js')}}"></script>

        @yield('extraJS')
        <script src="{{asset('Summernote/summernote.min.js')}}"></script>
        <script type="text/javascript">
            $(document).ready(function() {
            $('#summernotess').summernote({
                height: "300px",
                styleWithSpan: false
            });
            }); 
        </script>
    </body>
</html>