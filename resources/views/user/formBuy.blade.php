@extends('layouts.main')
@section('title','home')
@section('content')
<div class="row">
        <div class="col-12 p-5">
            <form action="{{route('buy',['id'=>$product->id])}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="selectProvinsi">select provinsi</label>
                    <select class="form-control" name="province" id="selectProvinsi">
                        <option value="0">Bali</option>
                        <option value="1">Bangka Belitung</option>
                        <option value="2">Banten</option>
                        <option value="3">Bengkulu</option>
                        <option value="4">Yogyakarta</option>
                        <option value="5">Jakarta</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="selectKota">select kota</label>
                    <select class="form-control" name="regency" id="selectKota">
                        <option value="0">Aceh</option>
                        <option value="1">Aceh barat</option>
                        <option value="2">Aceh Besar</option>
                        <option value="3">Aceh jaya</option>
                        <option value="4">Aceh selatan</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="selectProvinsi">select kurir</label>
                    <select class="form-control" name="courier" id="selectProvinsi">
                        <option value="1">JNE</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="alamat">address</label>
                    <input type="text" class="form-control" name="alamat" id="alamat" placeholder="alamat">
                </div>

                <div class="form-group">
                        <label for="qty">Qty</label>
                        <input type="text" class="form-control" name="qty" id="qty" value="1" placeholder=1>
                    </div>
                <div class="row">   
                    <div class="col-12 text-right">
                        <button type="submit" class="btn btn-primary btn-md">Pesan</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection