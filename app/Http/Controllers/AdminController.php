<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\Admin;
use Hash;
use _File;
class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin');
    }

    public function create(){
        return view('authAdmin.register');
    }

    public function store(Request $request){
    
        $this->validate($request,[
            'name' => 'required|string|max:191',
            'username'=>'required|string|max:191|unique:admins',
            'password'=>'required|min:8|string|confirmed',
            //'picture'=>'required',
            //'phone'=>'required'
        ]);
        
        $admin = Admin::create([
            'name' => $request->name,
            'username'=> $request->username,
            'password' => Hash::make($request->password),
            'profile_image'=> _FIle::storeImage($request,"admin"),
            'phone'=>$request->phone,
        ]); 

        return redirect()->route('admin.home');
    }
  
    
}