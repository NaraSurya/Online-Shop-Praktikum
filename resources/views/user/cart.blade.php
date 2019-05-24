@extends('layouts.main')
@section('title','home')
@section('content')
    <div class="container">
        <div class="row m-5">
            <div class="col-12 text-center bg-info p-3 text-white">
                <h5>Cart</h5>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                    <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>no</th>
                            <th>image</th>
                            <th>nama barang</th>
                            <th>harga </th>
                            <th>quantity</th>
                            <th>total</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($carts as $cart)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>
                                        <img src="{{ asset('uploads/products/' . $cart->product->product_images->first()->image_name) }}" 
                                        alt="{{ $cart->product->product_name }}" width="100px" height="100px">
                                </td>
                                <td>{{$cart->product->product_name}}</td>
                                <td id="price{{$cart->id}}">{{$cart->product->price}}</td>
                                <td>
                                    <form action="">
                                        <div class="form-group">
                                            <input type="number" id="qty{{$cart->id}}" onchange="qtyChangeListener({{$cart->id}},'qty{{$cart->id}}')" class="form-control w-25" id="quantity" value={{$cart->qty}}>
                                        </div>
                                    </form>
                                </td>
                                <td id="totalprice{{$cart->id}}">{{$cart->product->price*$cart->qty}}</td>
                                <td ><form action="{{route('cart.delete',['id'=>$cart->id])}}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form></td>
                            </tr>
                        @endforeach 
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-12 p-5">
                <form action="{{route('cart.detail')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="selectProvinsi">select provinsi</label>
                        <select class="form-control" name="provinsi" id="selectProvinsi">
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
                        <select class="form-control" name="kota" id="selectKota">
                                <option value="0">Aceh</option>
                                <option value="1">Aceh barat</option>
                                <option value="2">Aceh Besar</option>
                                <option value="3">Aceh jaya</option>
                                <option value="4">Aceh selatan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="selectProvinsi">select kurir</label>
                        <select class="form-control" name="kurir" id="selectProvinsi">
                            <option value="1">JNE</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="alamat">address</label>
                        <input type="text" class="form-control" name="alamat" id="alamat" placeholder="alamat">
                    </div>
                    <div class="row">   
                        <div class="col-12 text-right">
                            <button type="submit" class="btn btn-primary btn-md">Pesan</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
        
    </div>
@endsection

@section('script')

<script>
    function qtyChangeListener(id , qtyID){
        qty = document.getElementById(qtyID).value;
        console.log(qty);
        let url ='http://127.0.0.1:8000/user/qtycart/'.concat(id,'/',qty); 
        console.log(url);
        fetch(url).then(function(response) {
            return response.json();
        })
        .then(function(data) {
            let priceID = document.getElementById('totalprice'+data.id);
            let harga = document.getElementById('price'+data.id).innerHTML;
            console.log(harga);
            let qty = data.qty;
            priceID.innerHTML = qty * harga;
        });
    }
    
</script>
@endsection