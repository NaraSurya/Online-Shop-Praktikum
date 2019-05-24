@extends('layouts.main')
@section('title','home')
@section('content')
    <div class="container" >
        <div class="row my-5">
            <div class="col-3 my-5">
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                                <img src="{{ asset('uploads/products/'.$product->product_images->first()->image_name) }}" 
                                alt="{{ $product->product_name }}" class="d-block w-100" height="300px">
                         </div>
                        @foreach ($product->product_images as $image)
                            <div class="carousel-item">
                                    <img src="{{ asset('uploads/products/'.$image->image_name) }}" 
                                    alt="{{ $product->product_name }}" class="d-block w-100" height="300px">
                            </div>
                        @endforeach
                       
                        {{-- <div class="carousel-item">
                            <img src="http://via.placeholder.com/50x50" class="d-block w-100" height="300px" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="http://via.placeholder.com/50x50" class="d-block w-100" height="300px" alt="...">
                        </div> --}}
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
            <div class="col-6 my-5">
                <div class="mx-3 my-3">
                    <h3>{{$product->product_name}}</h3>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="mx-3 my-3">
                            harga
                            <h6>{{$product->price}}</h3>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mx-3 my-3">
                            <h5>rating</h5>
                            <h6>{{$product->product_rate}}</h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="mx-3 my-3">
                            <a href="{{route('buy.form',['id'=>$product->id])}}" class="btn btn-md btn-success w-100">Beli</a>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mx-3 my-3">
                            @if ($product->carts->where('status','notyet')->isEmpty())
                                <a href="{{ route('cart.addRemove', ["flag"=>"0","id"=>$product->id]) }}"class="btn btn-md btn-info">Add to cart</a>
                            @else
                                <a href="{{ route('cart.addRemove', ["flag"=>"1","id"=>$product->id]) }}"class="btn btn-md btn-info">remove to cart</a>
                            @endif
                          
                        </div>
                    </div>
                </div>
                <div class="mx-3 my-3">
                    <p>{{$product->description}}</p>
                </div>
                
            </div>
        </div>
        
            
    </div>
@endsection