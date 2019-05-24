<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\transaction;

class InvoiceController extends Controller
{
    public funtion index(){
        $transaction = transacttion::where('user_id',Auth::user()->id)->orderByDesc('id')->get();
        return view('user.invoice',['transactions'=>$transaction]);
    }
}
