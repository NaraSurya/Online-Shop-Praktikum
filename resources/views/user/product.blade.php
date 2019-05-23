@extends('layouts.main')
@section('title','home')
@section('content')
    <div class="container" >
        <div class="row my-5">
            <div class="col-3 my-5">
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="http://via.placeholder.com/50x50" class="d-block w-100" height="300px" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="http://via.placeholder.com/50x50" class="d-block w-100" height="300px" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="http://via.placeholder.com/50x50" class="d-block w-100" height="300px" alt="...">
                        </div>
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
                    <h3>Nama Barang</h3>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="mx-3 my-3">
                            <h6>Harga Barang</h3>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mx-3 my-3">
                            <h6>Rating Barang</h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="mx-3 my-3">
                            <a href="" class="btn btn-md btn-success w-100">Beli</a>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mx-3 my-3">
                            <a href="" class="btn btn-md btn-info">Add to cart</a>
                        </div>
                    </div>
                </div>
                <div class="mx-3 my-3">
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Excepturi maiores illum distinctio nemo debitis repellendus, numquam nostrum modi ad quo dolorem veniam sed quibusdam inventore facilis nobis ex! Adipisci, cupiditate?</p>
                </div>
                
            </div>
        </div>
        
            
    </div>
@endsection