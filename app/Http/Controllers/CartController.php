<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\cart;
use Illuminate\Http\Response;
use Illuminate\Database\Eloquent\Collection;
use session;
use App\transaction;
use Carbon\Carbon;
use GuzzleHttp\Client;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');
    }
    
    public function index(){
        $user_id = Auth::user()->id;
        $carts =  cart::where('user_id',$user_id)
                        ->where('status','notyet')->get();
        
        return view('user.cart',['carts'=>$carts]);
    }
    public function addRemoveCart(Request $request){
        $user_id = Auth::user()->id;
        if($request->flag == 0){
            $cart = cart::create([
                "user_id" => $user_id , 
                "product_id" => $request->id, 
                "qty" => 1,
                "status" => "notyet"
            ]);
        } else {
            $cart = cart::where('product_id',$request->id)
                          ->where('user_id',$user_id)
                          ->where('status','notyet');
            $cart->delete();
        }
       

        return redirect()->back();
    }

    public function updateQuantity(Request $request){
        $cart = cart::find($request->id);
        $cart->qty = $request->qty;
        $cart->save();
        return response($cart,200);
    }

    public function deleteCart(Request $request){
        $cart = cart::find($request->id);
        $cart->delete();
        return redirect()->back();
    }

    public function detailCart(Request $request){
        $user_id = Auth::user()->id;
        $carts = cart::where('user_id',$user_id)->where('status','notyet')->get();

        session(['provinsi'=>$request->provinsi, 'kota'=> $request->kota , 'kurir'=>$request->kurir , 'alamat'=>$request->alamat]);

        foreach($carts as $cart){
            $totalHarga = $cart->qty * $cart->product->price - ($cart->product->price * $cart->product->discount / 100);
            $cart->total_price = $totalHarga;
        }
        return view('user.detailCart',['carts'=>$carts]);
    }

    public function buy(Request $request){
        $carts = cart::where('user_id',Auth::user()->id)->where('status','notyet')->get();
        return $this->buying($request,$carts);
    }

   

    public function buying(Request $request , $carts){
        $provinsi = session('provinsi');
        $kota   = session('kota');
        $alamat = session('alamat');
        $kurir = session('kurir');

        $shipping = $this->shipping($kota , $provinsi);

     
        $transaction = transaction::create([
            'timeout' => Carbon::now()->setTimezone('Asia/Singapore')->addDay(1),
            'address'=> $alamat,
            'regency' => $kota,
            'province' =>$provinsi,
            'total' => $request->total,
            'shipping_cost' => $shipping,
            'sub_total' => $request->sub_total , 
            'user_id'=> Auth::user()->id,
            'courier_id' => $kurir,
            'proof_of_payment'=>null,
            'status'=>"unverified" 
        ]);
      

        foreach($carts as $cart){
            $transaction->product()->attach($cart->product->id,[
                "qty"=> $cart->qty,
                "discount" => $cart->product->discount, 
                "selling_price"=> $cart->product->price
            ]);


            $cart->status = "checkedout";
            $cart->save();
        }

       
        return redirect()->route('transaction.show',['id'=>$transaction->id]);
        //return view('user.invoice', ["transaction"=> $transaction]);
    }

    public function shipping($kota , $provinsi){
        $client = new Client();
        try{
            $response = $client->request('POST','https://api.rajaongkir.com/starter/cost',
               [
                'body' => "origin=501&destination=114&weight=1700&courier=jne",
                'headers' => [
                    'key' => '67080eb678897a09f70e6c8ae553f4cf',
                    "content-type" => "application/x-www-form-urlencoded",
                ]
               ]
            );
        } catch (RequestException $e){
            var_dump($e->getResponse()->getBody()->getContents());
        }

        $json = $response->getBody()->getContents();
        $array_result = json_decode($json,true);

        return $array_result["rajaongkir"]["results"][$provinsi]["costs"][$kota]["cost"][0]["value"];

    }


}
