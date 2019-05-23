
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
                    <h1 class="page-header">Data User</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            User Koperasi Simpan Pinjam Online
                        </div>
                        <div class="row">
                            <div class="col-lg-10" style="margin-top: 20px; margin-left: 20px;">
                                <form class="form-group" action="/cariNasabah" method="get">
                                    <div class="row">
                                        <div class="col-lg-8">
                                        <input type="text" class="form-control" name="id" size="25" maxlength="10" placeholder="cari User" /></div>
                                        <div class="col-lg-4">
                                        <input type="submit" name="Submit" class="btn btn-primary" value="Search"></div>
                                    </div>
                                </form>
                            </div>
                        </div>  
                        <input type="button" value="+ courier" class="btn btn-primary" onclick=location.href="{{ route('admin.tambahCourier')}}" title="Add Courier" style="margin-left: 20px;">
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>  
                                        <th>no.</th>
                                        <th>id</th>
                                        <th>nama_courier</th>
                                        <th>created_at</th>
                                        <th>update_at</th>
                                        <th>opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                     @if(\Session::has('alert'))

                                            <div class="alert alert-danger">

                                                <div>{{Session::get('alert')}}</div>

                                            </div>

                                        @endif

                                        @if(\Session::has('alert-success'))

                                            <div class="alert alert-success">

                                                <div>{{Session::get('alert-success')}}</div>

                                            </div>

                                        @endif

                                
                                @php(
                                      $no = 1 {{-- buat nomor urut --}}
                                            )
                                @if(count($panggil)>0)
                                 @foreach ($panggil as $angs)
                                <tr align="center">
                                    <td>{{ $no++ }}<div align="center"></div></td>
                                    @if($angs->id==null)
                                    <td>ga ada data<div align="center"></div></td>
                                     @else
                                        <td>{{ $angs->id}}<div align="center"></div></td>
                                    @endif
                                    @if($angs->courier==null)
                                    <td>ga ada data<div align="center"></div></td>
                                     @else
                                        <td>{{ $angs->courier}}<div align="center"></div></td>
                                    @endif
                                    @if($angs->created_at==null)
                                    <td>ga ada data<div align="center"></div></td>
                                     @else
                                        <td>{{ $angs->created_at}}<div align="center"></div></td>
                                    @endif
                                    @if($angs->updated_at==null)
                                    <td>ga ada data<div align="center"></div></td>
                                     @else
                                        <td>{{ $angs->updated_at}}<div align="center"></div></td>
                                    @endif
                                     <td bgcolor="#EEF2F7"><a href="{{ URL('admin/editCourier')}}/{{$angs->id}}">Edit</a></div></td>
              
                                </tr>
                                         @endforeach
                                </tbody>
                                @else
                                <td>ga ada data<div align="center"></div></td>
                                @endif
                            </table>
                           
                            
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            
        </div>
        <!-- /#page-wrapper -->
    @stop
        

    
</div>


<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/metisMenu.min.js')}}"></script>

<script src="{{asset('js/dataTables.bootstrap.min.js')}}"></script>
<script src="{{asset('js/dataTables.responsive.js')}}"></script>
<script src="{{asset('js/sb-admin-2.js')}}"></script>



    <script>
        $(document).ready(function() {
            $('#dataTables-example').DataTable({
                responsive: true
            });
        });
    </script>



</body>
</html>