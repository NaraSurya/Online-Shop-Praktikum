<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\product;
use App\transaction;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;

class BuyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');
    }

    public function buyItem(Request $request){
        $product = product::find($request->id);
        return view('user.formBuy',['product'=>$product]);
    }

    public function buy(Request $request){
        $product = product::find($request->id);
    

        $alamat = $request->alamat;
        $regency = $request->regency;
        $province = $request->province;
        $qty = $request->qty;
        $shipping_cost = this->shipping($regency,$province);
        $sub_total = $product->price * $qty;
        $total = ($sub_total + $shipping_cost)*$product->discount / 100; 
        $courier_id = $request->courier;

        $transaction = transaction::create([
            'timeout' => Carbon::now()->setTimezone('Asia/Singapore')->addDay(1),
            'address'=> $alamat,
            'regency' => $regency,
            'province' =>$province,
            'total' => $total,
            'shipping_cost' => $shipping_cost,
            'sub_total' => $sub_total , 
            'user_id'=> Auth::user()->id,
            'courier_id' => $courier_id,
            'proof_of_payment'=>null,
            'status'=>"unverified" 
        ]);
            
        $transaction->product()->attach($product->id,[
            "qty"=> $qty,
            "discount" => $product->discount, 
            "selling_price"=> $product->price
        ]);
        
        return redirect()->route('transaction.show',['id'=>$transaction->id]);
        
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
