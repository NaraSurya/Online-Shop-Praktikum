<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Koperasi Simpan Pinjam Online | Admin</title>
    
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('css/metisMenu.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('css/dataTables.bootstrap.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('css/dataTables.responsive.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('css/sb-admin-2.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet" type="text/css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
        <script type="text/javascript">
        $(window).load(function() {
        $(".loader").fadeOut("slow");
        });
        </script>
<style type="text/css">
.loader {
    position: fixed;
    left: 0px;
    top: 0px;
    width: 100%;
    height: 100%;
    z-index: 9999;
    background: url('images/pageLoader.gif') 50% 50% no-repeat rgb(249,249,249);
    opacity: .8;
}
</style>
    <!--<link href="style.css" rel="stylesheet" type="text/css">-->
</head>
<body>
<div class="loader"></div>
<div id="wrapper">

    @extends('master')

    @section('top-navbar')
        @parent

    @stop

    @section('navbar')
        @parent

    @stop

            
    @section('content')

    <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">product</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           Admin Prognet
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                @if(\Session::has('alert'))

                                    <div class="alert alert-danger">

                                        <div>{{Session::get('alert')}}</div>

                                    </div>

                                    @endif

                                    <form action="{{ route('admin.storeEditMahasiswa') }}"method="post" enctype="multipart/form-data">
                                   
                                    {{ csrf_field() }}
                                   
                                         @foreach ($editMahasiswa as $angs)
                                         <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>nama</label>
                                                    <input class="form-control" type="text"  name="nama" placeholder="nama"value ="{{$angs->nama}}" >
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>umur </label>
                                                    <input class="form-control" id="price" type="text" name="umur" placeholder="umur"value ="{{$angs->umur}}" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>nim</label>
                                                    <input class="form-control" id="discount" type="text" name="nim" placeholder="nim" value ="{{$angs->nim}}">
                                                </div>
                                            </div>
                                        <div class="col-lg-6">
                                        @if (!empty($angs->nama_photo))
                                            <img src="{{ asset('uploads/products/' . $angs->nama_photo) }}" 
                                            alt="{{ $angs->nama }}" width="150px" height="150px">
                                        @else
                                             <img src="http://via.placeholder.com/150x150" alt="{{ $angs->nama }}">
                                         @endif
                                         <div class="form-group">
                                                <label for="">Foto</label>
                                                <input type="file" name="photo" class="form-control">
                                                <p class="text-danger">{{ $errors->first('photo') }}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                  <label>konsentrasi</label>
                                                <select class="form-control" name="konsentrasi" >
                                                    <option value="{{$angs->konsentrasi}}">{{$angs->konsentrasi}}</option>
                                                    <option value="teknologicerdas">teknologi cerdas</option>
                                                    <option value="jaringan">jaringan</option>
                                                    <option value="manajemen bisnis">manajemen bisnis</option>
                                                    <option value="databaseintegrasi">mdi</option>
                                                  </select>
                                                </div>
                                        </div>
                
                                             @endforeach
                                       

                                        <input type="submit" name="Submit" value="Submit" class="btn btn-primary">

                                        <input type="button" value="Cancel" onclick=location.href="{{ url('/tampilNasabah') }}" title="Cancel" class="btn btn-default">

                        </form>
                    </div>
                </div>
            </div>
    @stop



</div>

<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/metisMenu.min.js')}}"></script>
<script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('js/dataTables.bootstrap.min.js')}}"></script>
<script src="{{asset('js/dataTables.responsive.js')}}"></script>
<script src="{{asset('js/sb-admin-2.js')}}"></script>

</body>
</html>