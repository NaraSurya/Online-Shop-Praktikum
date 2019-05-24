<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\transaction;
use Illuminate\Support\Facades\Auth;
use _File;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');
    }

    public function index(){
        $transaction = transaction::where('user_id',Auth::user()->id)->orderByDesc('id')->get();
        return view('user.transaction.index',['transactions'=>$transaction]);
    }
    public function show(Request $request){
        $transaction = transaction::find($request->id);
        return view('user.invoice',['transaction'=>$transaction]);
    }
    public function postPayment(Request $request,$id){
      $request->validate([
          'picture' => 'required'
      ]);
      
    
        $transaction = transaction::find($id);
        $transaction->proof_of_payment = _FIle::storeImageWithName($request,Auth::user()->id,"proof_for_payment");
        $transaction->save();
        
        return redirect()->back()->with(['success'=>"bukti pembayaran anda sudah berhasil dikirim"]);
    }
}
