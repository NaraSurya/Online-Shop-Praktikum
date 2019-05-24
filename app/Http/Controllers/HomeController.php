<?php

namespace App\Http\Controllers;
use DB;
use App\product;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products=DB::select("call ambilProduct");
        return view('welcome', ['products'=>$products]);
    }

    public function product(Request $request){
        $product = product::find($request->id);
        return view('user.product',['product'=>$product]);
    }
}
