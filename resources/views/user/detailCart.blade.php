@extends('layouts.main')
@section('title','home')
@section('content')
    <div class="row">
        <div class="col-12 p-5">
            <h5 class="bg-info text-white text-center">Confirmasi</h5>
        </div>
    </div>
    <div class="row">   
        <div class="col-12">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>no</th>
                        <th>barang</th>
                        <th>qty</th>
                        <th>total harga</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($carts as $cart)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$cart->product->product_name}}</td>
                            <td>{{$cart->qty}}</td>
                            <td>{{$cart->total_price}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <h5 class="text-info m-3">total  : Rp. {{$carts->sum('total_price')}}</h5>
        </div>
        <div class="col-12">
            <h5 class="text-info m-3">biaya ongkir  : Rp. </h5>
        </div>
        <div class="col-12">
            <h5 class="text-info m-3">total pembayaran: Rp. {{$carts->sum('total_price') + 250000}}</h5>
        </div>
    </div>
    <div class="row">
        <div class="col-12 text-center">
            <form action="{{route('cart.buy')}}" method="POST">
                @csrf
                <input type="hidden" name="sub_total" value="{{$carts->sum('total_price')}}">
                <input type="hidden" name="shipping_cost" value="250000">
                <input type="hidden" name="total" value="{{$carts->sum('total_price') + 250000}}">
                <button type="submit" class="btn btn-submit btn-md">beli</button>
            </form>
        </div>
    </div>
@endsection