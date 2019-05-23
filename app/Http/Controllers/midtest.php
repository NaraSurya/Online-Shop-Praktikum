<?php

namespace App\Http\Controllers;
use File;
use Image;
use DB;
use App\Admin;
use App\User;
use App\notifikasi;
use Hash;
use Illuminate\Support\Facades\Session;
use Notification;
use App\Notifications\NewItem;
use Illuminate\Http\Request;

class midtest extends Controller
{

public function dataMahasiswa()
{  
    $dataMahasiswa=DB::select('call ambilDataMahasiswa');
    return view('dataMahasiswa',compact('dataMahasiswa'));
}

public function tambah()
{
    return view('createMahasiswa');
}

public function Storetambah(Request $req)
{
    $validate = \Validator::make($req->all(),[
        'nama' => 'required|string|max:100',
        'nim' => 'required|integer|max:15',
        'umur' => 'required|integer|max:2',
        'konsentrasi'=> 'required|string|max:100',
        'photo' => 'required|image|mimes:jpg,png,jpeg' 
    ]);

    if($validate->fails()){
        return redirect()->back()->with('alert','error');
    }
    $photo = null;
    if ($req->hasFile('photo')) {
        
          $photo = $this->saveFile($req->nama, $req->file('photo'));
    }
    $data2=[
          'nama'=>$req->nama,
          'nim'=>$req->nim,
          'umur'=>$req->umur,
          'konsentrasi'=>$req->konsentrasi,
          'nama_photo'=>$photo,
          ];
      DB::table('tb_mahasiswa')->insert($data2);
      return redirect()->route('admin.dataMahasiswa');
    
}

public function saveFile($product_name, $photo){
    $images = str_slug($product_name) . time() . '.' . $photo->getClientOriginalExtension();
    $path = public_path('uploads/products');
    if (!File::isDirectory($path)) {
        File::makeDirectory($path, 0777, true, true);
    } 
    Image::make($photo)->save($path . '/' . $images);
    return $images;
    }
public function editMahasiswa($id)
{
    $editMahasiswa=DB::select('call editMahasiswa (?)',[$id]);
    return view('editMahasiswa',compact('editMahasiswa'));
}
public function storeEditMahasiswa(Request $req)
{
    $validate = \Validator::make($req->all(),[
        'nama' => 'required|string|max:100',
        'nim' => 'required|integer|max:15',
        'umur' => 'required|integer|max:2',
        'konsentrasi'=> 'required|string|max:100',
        'photo' => 'required|image|mimes:jpg,png,jpeg' 
    ]);

    if($validate->fails()){
        return redirect()->back()->with('alert','error');
    }
    $photo = null;
    if ($req->hasFile('photo')) {
        
          $photo = $this->saveFile($req->nama, $req->file('photo'));
    }
    $data2=[
          'nama'=>$req->nama,
          'nim'=>$req->nim,
          'umur'=>$req->umur,
          'konsentrasi'=>$req->konsentrasi,
          'nama_photo'=>$photo,
          ];
    DB::table('tb_mahasiswa')->where('nim',$req->nim )->update($data2);
    return redirect()->route('admin.dataMahasiswa');
}
public function hapusMahasiswa($id)
{
    DB::select('call deleteMahasiswa (?)',[$id]);
    return redirect()->route('admin.dataMahasiswa');
}
public function sendNotification()
{
    $user = User::first();

    $details = [
        'greeting' => 'Hi Artisan',
        'body' => 'This is my first notification from ItSolutionStuff.com',
        'thanks' => 'Thank you for using ItSolutionStuff.com tuto!',
        'actionText' => 'View My Site',
        'actionURL' => url('/'),
        'order_id' => 101
    ];

    Notification::send($user, new NewItem($details));

    dd($user->notifications);
}
}
lkkk
