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
     <script src="{!! asset('js/jquery-3.3.1.min.js') !!}"></script>
     <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
      <script src="//code.jquery.com/jquery-3.3.1.min.js"></script>
       <script type="text/javascript">
        $(document).ready(function() {
        $('#nama').keyup(function(){
            var nama= $('#nama').val();
            var len= nama.length;
            if(len>0){ //jika ada isinya
                if(!valid_nama(nama)){ //jika nama tidak valid
                    swal("error","NAMA TIDAK BOLEH ANGKA DAN SIMBOL LAINNYA");
                    $('#nama').val();
                } else {
                    if (len>20){ //jika karakter >30
                        swal("error","maksimal 20 karakter");
                        $('#nama').val();
                    }
                }
            } 
        });
        $('#telepon').keyup(function(){
            var telepon=$('#telepon').val();
            var len=telepon.length;
            if(!valid_hp(telepon)){
                swal("error","TELEPON TIDAK BOLEH HURUF DAN SIMBOL LAINNYA");
                $('#telepon').val(62);

            }else if(len > 12){
                swal("error","no hp tidak boleh lebih dari 12");
                 $('#telepon').val(62);
            }
        });
        $('#ktp').keyup(function(){
            var telepon=$('#ktp').val();
            var len=telepon.length;
            if(!valid_hp(telepon)){
                swal("error","TELEPON TIDAK BOLEH HURUF DAN SIMBOL LAINNYA");
                $('#ktp').val();

            }else if(len > 15){
                swal("error","no hp tidak boleh lebih dari 15");
                 $('#ktp').val();
            }
        });
          $('#formNas').submit(function(e){
             e.preventDefault();
                swal({
                         title: "Konfirmasi Simpan Data",
                              text: "Data Akan di Simpan Ke Database",
                              type: "info",
                              showCancelButton: true,
                              confirmButtonColor: "#1da1f2",
                              confirmButtonText: "Yakin, dong!",
                              closeOnConfirm: false,
                              showLoaderOnConfirm: true,
                        }, function () { //apabila sweet alert d confirm maka akan mengirim data ke simpan.php melalui proses ajax
                        $.ajax({
                            url: '/nambahPostNasabah',
                            type: 'GET',
                            data: $('#formNas').serialize(), //serialize() untuk mengambil semua data di dalam form
                            dataType: "HTML",
                            success: function(){                
                                setTimeout(function(){
                                  swal({
                                    title:"Data Berhasil Disimpan",
                                    text: "Terimakasih",
                                    type: "success"
                                  }, function(){
                                    window.location.href = "/viewNasabah";

                                  });
                                }, 2000);
                            },
                            error: function (xhr, ajaxOptions, thrownError) {
                                setTimeout(function(){
                                    swal("Error", "Tolong cek kembali form nya", "error");
                                }, 2000);}
                });
                });
            
        });
          
     function valid_nama(nama) {
        var pola= new RegExp(/^[a-z A-Z]+$/);
        return pola.test(nama);
    }
    function valid_hp(telepon){
        var pola = new RegExp(/^[0-9-+]+$/);
        return pola.test(telepon);
    }

    });

        </script>

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
                    <h1 class="page-header">Tambah Data Nasabah</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Nasabah Koperasi Simpan Pinjam Online
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form role="form" id="formNas">
                                   
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                  <label>kategory</label>
                                                <select class="form-control" name="kategori" >
                                                @foreach($productCat as $angs1)
                                                  <option value="{{$angs1->id}}">{{$angs1->category_name}}</option>
                                                  @endforeach
                                                  </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                  <label>product</label>
                                                <select class="form-control" name="product" >
                                                @foreach($productTemp as $angs)
                                                  <option value="{{$angs->id}}">{{$angs->product_name}}</option>
                                                  @endforeach
                                                  </select>
                                                </div>
                                            </div>
                                        </div>
                                        
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