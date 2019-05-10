
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
    <link href="{{asset('css/sb-admin-2.css')}}" rel="stylesheet" type="text/css"/>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
    <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet" type="text/css"/>

    <!--<link href="style.css" rel="stylesheet" type="text/css">-->
</head>
<body>

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
                    <h1 class="page-header">Detail Product</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            User Admin Prognet
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="example">
                                <thead>
                                    <tr>  
                                        <th>No.</th>
                                        <th>kategori</th>
                                        <th>product</th>
                                        <th>created_at</th>
                                        <th>updated_at</th>
                                        <th>aksi</th>
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
                                @if(count($product2)>0)
                                    @foreach ($product2 as $angs)
                                    <td>{{$no}}<div align="center"></div></td> 
                                    @if($angs->category_name==null)
                                    <td>ga ada data<div align="center"></div></td>
                                     @else
                                        <td>{{ $angs->category_name}}<div align="center"></div></td>
                                    @endif
                                    @if($angs->product_name==null)
                                    <td>ga ada data<div align="center"></div></td>
                                     @else
                                        <td>{{ $angs->product_name}}<div align="center"></div></td>
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
                                     <td bgcolor="#EEF2F7"><a href=>Edit</a></div></td>

                                </tr>
                                         @endforeach
                                </tbody>
                                @else
                                <td>ga ada data<div align="center"></div></td>
                                @endif
                            </table>
                            <input type="button" value="+ product" class="btn btn-primary" onclick=location.href="{{ route('admin.tambahDetailCatProduct')}}" title="Add User" style="margin-right:">
                            
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
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script src="{{asset('js/sb-admin-2.js')}}"></script>

    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                responsive: true
            });
        });
    </script>



</body>
</html>