@extends('layouts.main')
@section('title','home')
@section('content')
  
    <div class="row">
        <div class="col-12 p-5 bg-info text-white text-center">
            <h5>Invoice</h5>
        </div>
    </div>
    <div class="row px-5 my-2">
        <div class="col-6">
            <h6>total : {{$transaction->total}}</h6>
        </div>
        <div class="col-6">
            <h6>sub total : {{$transaction->sub_total}}</h6>
        </div>
    </div>
    <div class="row px-5 my-3">
        <div class="col-6">
            <h6>shipping cost :{{$transaction->shipping_cost}}</h6>
        </div>
        @if (is_null($transaction->proof_of_payment))
            <div class="col-6">
                <h6>Time Out</h6>
                <h6 id="timer" ></h6>
            </div>
        @else
            <div class="col-6">
                <h6>status :{{$transaction->status}}</h6>
            </div>
        @endif
       
    </div>
    @if (is_null($transaction->proof_of_payment))
        <div class="row px-5">
            <div class="col-6">
                <form action="{{route('transaction.postPayment',['id'=>$transaction->id])}}" method="Post"  enctype="multipart/form-data">
                <div class="row">
                        @csrf
                        <div class="col-md-6">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="picture" id="picture">
                                <label class="custom-file-label" for="picture">Choose file</label>
                            </div>
        
                            @if ($errors->has('picture'))
                            
                                    <strong>{{ $errors->first('picture') }}</strong>
                            
                            @endif
                        </div>
                        <div class="col-md-6 text-left">
                            <Button type="submit" class="btn btn-sm btn-primary mx-3 my-1">post</Button>
                        </div>
                </div>
                </form>
            </div>
        </div>
    @endif
    @if (!is_null($transaction->proof_of_payment))
        <div class="row">
            <div class="col-12 px-5 my-3">
                <h5>Bukti sudah terkirim</h5>
                <a href="{{ asset('/storage/proof_for_payment/'.$transaction->proof_of_payment) }}">
                    <img src="{{ asset('/storage/proof_for_payment/'.$transaction->proof_of_payment) }}" width="100px" height="100px"  class="rounded" alt="">
                </a>
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-12 px-5 my-3">
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
                            @foreach ($transaction->product as $product )
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$product->product_name}}</td>
                                    <td>{{$product->pivot->qty}}</td>
                                    <td>{{$product->pivot->selling_price*$product->pivot->qty}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
        </div>
    </div>
        
@endsection
@section('script')
    <script>
        @if (Session::has('success'))
            alert("{{Session::get('success')}}");
        @endif
        var countDownDate = new Date('{{$transaction->timeout}}').getTime();
        console.log(countDownDate);
        // Update the count down every 1 second
        var x = setInterval(function() {

        // Get today's date and time
        var now = new Date().getTime();

        // Find the distance between now and the count down date
        var distance = countDownDate - now;

        // Time calculations for days, hours, minutes and seconds
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Display the result in the element with id="demo"
        document.getElementById("timer").innerHTML = days + "d " + hours + "h "
        + minutes + "m " + seconds + "s ";

        // If the count down is finished, write some text 
        if (distance < 0) {
            clearInterval(x);
            document.getElementById("timer").innerHTML = "EXPIRED";
        }
        }, 1000);
    </script>
@endsection