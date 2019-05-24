@extends('layouts.main')
@section('title','home')
@section('content')
<div class="row">
        <div class="col-12 p-5">
            <h5 class="bg-info text-white text-center">Riwayat</h5>
        </div>
    </div>
    <div class="row">   
        <div class="col-12">
            <table class="table table-borderless">
                <thead>
                    <tr>
                        <th>no</th>
                        <th>tanggal beli</th>
                        <th>total harga</th>
                        <th>status</th>
                        <th>#</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transactions as $transaction)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$transaction->created_at}}</td>
                            <td>{{$transaction->total}}</td>
                            <td>{{$transaction->status}}</td>
                            <td><a href="{{route('transaction.show',['id'=>$transaction->id])}}" class="btn btn-sm btn-info">detail</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection