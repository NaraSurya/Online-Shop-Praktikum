<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin Prognet</title>
    
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('css/metisMenu.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('css/dataTables.bootstrap.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('css/dataTables.responsive.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('css/sb-admin-2.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('css/morris.css')}}" rel="stylesheet" type="text/css"/>



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
                    <h1 class="page-header">Dashboard Prognet</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            

                <div class="col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bell fa-fw"></i> Notifications Panel
                        </div>
                        //



                        //
                    
                        <div class="panel-body">
                            <div class="list-group">
                                <a href="#" class="list-group-item">
                                    <i class="fa fa-comment fa-fw"></i> Username
                                    <span class="pull-right text-muted small"><em> {{ Auth::user()->name }}</em>
                                    </span>
                                </a>
                                <a href="#" class="list-group-item">
                                    <i class="fa fa-twitter fa-fw"></i> User Level
                                    <span class="pull-right text-muted small"><em>{{Session::get('user_role')}}</em>
                                    </span>
                                </a>
                                   <a href="#" class="list-group-item">
                                    <i class="fa fa-twitter fa-fw"></i> generarate
                                    <span class="pull-right text-muted small"><em>{{Session::get('notif')}}</em>
                                    </span>
                                </a>
                                  <a href="#" class="list-group-item" id="auto">
                                    <i class="fa fa-twitter fa-fw"></i> auto generated
                                    @if(Session::get('auto') == 1)
                                        <span class="pull-right text-muted small"><em>ON</em></span>
                                    @elseif(Session::get('auto') == 0)
                                        <span class="pull-right text-muted small"><em>OFF</em></span>
                                     @endif
                                    
                                </a>
                                <a href="#" class="list-group-item">
                                    <i class="fa fa-envelope fa-fw"></i> User Role
                                    @if(Session::get('user_role') == 1)
                                        <span class="pull-right text-muted small"><em>Pengelola Simpanan</em></span>
                                    @elseif(Session::get('user_role') == 2)
                                        <span class="pull-right text-muted small"><em>Pengelola Pinjaman</em></span>
                                    @elseif(Session::get('user_role') == 3)
                                        <span class="pull-right text-muted small"><em>Admin</em></span>
                                    @endif
                                    
                                </a>
                            </div>
                            <form role="form" id="formInput">
                            <!-- /.list-group -->
                            <!--<input type="submit" name="Submit" value="auto generated" class="btn btn-default btn-block">
                            </form>
                        </div>
                     
                    </div>
                    /.panel -->
    @stop
</div>
<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/metisMenu.min.js')}}"></script>
<script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('js/dataTables.bootstrap.min.js')}}"></script>
<script src="{{asset('js/dataTables.responsive.js')}}"></script>
<script src="{{asset('js/sb-admin-2.js')}}"></script>
<script src="{{asset('js/morris.min.js')}}"></script>
<script src="{{asset('js/morris-data.js')}}"></script>
<script src="{{asset('js/raphael.min.js')}}"></script>

                    
</body>
</html>