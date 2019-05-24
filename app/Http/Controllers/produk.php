<?php
namespace App\Http\Controllers;
use File;
use Image;
use DB;
use App\admin;
use App\adminNot;
use App\transactions;
use Hash;
use Illuminate\Http\Request;
use App\Notifications\NewItem;
use Carbon\Carbon;
use Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class produk extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function catProduct()
    {
        $product=DB::select("call productCat");
        return view('productCat',compact('product'));
    }   

    public function tambahCatProduct(){
        return view('tambahCatProduct');
    }

    public function storeCatProduct(Request $req){
        $tanggal=date("Y-m-d H:i:s");
        $data=[
            'category_name'=>$req->category_name,
            'created_at'=>$tanggal
            ];
        DB::table('product_categories')->insert($data);
    }   
    public function Product(){
        $product1=DB::select("call ambilProduct");
        return view('productList',compact('product1'));
    }
    public function tambahProduct(){
        $productCat=DB::select('call ProductNICat');
        return view('product',compact('productCat'));
    }
    public function storeTambProduct(Request $req){
        $tanggal=date("Y-m-d H:i:s");
        $ambilId=DB::select('call ambilId');
        foreach ($ambilId as $key ) {
            $idTemp=$key->id;
        }
        if($idTemp==NULL){
            $id=1;
        }else{
            $id=$idTemp+1;
        }
       $nama=$req->product_name;
       
        auth()->user()->notify(new NewItem('bramasta ganteng'));
        $data1=[
            'product_name'=>$req->product_name,
            'price'=>$req->price,
            'discount'=>$req->discount,
            'description'=>$req->deskripsi,
            'created_at'=>$tanggal,
            'stock'=>$req->stok,
            'berat'=>$req->berat,
            ];
        DB::table('products')->insert($data1);
        $data3=[
            'category_id'=>$req->kategori,
            'product_id'=>$id,
            'created_at'=>$tanggal,
        ];
        DB::table('product_category_details')->insert($data3);
             //default $photo = null
            $photo = null;
            //jika terdapat file (Foto / Gambar) yang dikirim
            if ($req->hasFile('photo')) {
                //maka menjalankan method saveFile()
                $photo = $this->saveFile($req->product_name, $req->file('photo'));
            }
            $data2=[
                'product_id'=>$id,
                'image_name'=>$photo,
                'created_at'=>$tanggal
                ];
            DB::table('product_images')->insert($data2);
            return redirect()->route('admin.Product');
       
       
        
    }
    public function saveFile($product_name, $photo){
    $images = str_slug($product_name) . time() . '.' . $photo->getClientOriginalExtension();
    $path = public_path('uploads/products');
    if (!File::isDirectory($path)) {
        //maka folder tersebut dibuat
        File::makeDirectory($path, 0777, true, true);
    } 
    Image::make($photo)->save($path . '/' . $images);
    //mengembalikan nama file yang ditampung divariable $images
    return $images;
    }

    public function detailCatProduct(){
        $product2=DB::select("call detailCatProduct");
        return view("detailProduct",compact('product2'));
    }
    public function tambahDetailCatProduct(){
        $productCat=DB::select('call ProductNICat');
        $productTemp=DB::select('call ProductNI');
        return view("tambDetProduct",compact('productCat','productTemp'));
    }
    public function editProduct($id){
        $id1=$id;
        $product1=DB::select("call editProduct (?)",[$id1]);
        foreach ($product1 as $key ) {
            $idImages=$key->id;
            $idProduct=$key->idProduct;
        }
        $cat=DB::select("select * from product_categories");
        $dataCat=DB::select("call ambilCat (?)",[$idProduct]);
        foreach ($dataCat as $key ) {
            $catId=$key->category_id;
            $catName=$key->category_name;
        }
        Session::put('idImages',$idImages);
        Session::put('idProduct',$idProduct);
        return view("editProduct",compact('product1','cat','catId','catName'));
    }
    public function storeEditProduct(Request $req){
        auth()->user()->notify(new NewItem('update bramasta'));
        $tanggal=date("Y-m-d H:i:s");
        $idProduct=Session::get('idProduct'); 
        $idImages=Session::get('idImages');
        $nilai=6;
        $admin = admin::find(Auth::id());
        $admin->unreadNotifications()->update(['notifiable_id' => $nilai]);
        $dataProduct=[
            'product_name'=>$req->product_name,
            'price'=>$req->price,
            'description'=>$req->deskripsi,
            'updated_at'=>$tanggal,
            'stock'=>$req->stok,
            'discount'=>$req->discount

        ];
        DB::table('products')->where('id', $idProduct)->update($dataProduct);
               //default $photo = null
            $photo = null;
            //jika terdapat file (Foto / Gambar) yang dikirim
            if ($req->hasFile('photo')) {
             //maka menjalankan method saveFile()
            $photo = $this->saveFile($req->product_name, $req->file('photo'));
            }
        $dataImages=[
            'product_id'=>$idImages,
            'image_name'=>$photo,
            'updated_at'=>$tanggal
        ];
        DB::table('product_images')->where('id', $idImages)->update($dataImages);
        return redirect()->route('admin.Product');
        Session::flush();
        
    }
    public function tambahCourier(){
        $panggil=DB::select('select * FROM couriers');
        return view("dataCourier",compact('panggil'));
    }
    public function tambahCourierBaru(){
        return view("tambahDataCourier");
    }
    public function storeCourier(Request $req){
        $tanggal=date("Y-m-d H:i:s");
        $dataProduct=[
            'courier'=>$req->Courier,
            'created_at'=>$tanggal,
        ];
        DB::table('couriers')->insert($dataProduct);
    }
    public function editCourier($id){
        
        Session::put('idCourier',$id);
        $panggil=DB::select('select courier FROM couriers where id=?', array($id));
        foreach ($panggil as $key ) {
           $cat=$key->courier;
        }
        return view('editCourier',compact('cat'));
    }
    public function storeEditCourier(Request $req){
    
        $id=Session::get('idCourier');
        $tanggal=date("Y-m-d H:i:s");
        $dataProduct=[
            'courier'=>$req->Courier,
            'updated_at'=>$tanggal,
        ];
        DB::table('couriers')->where('id', $id)->update($dataProduct);
    }
    public function markReadAdmin(){
        $tanggal=date("Y-m-d H:i:s");
        $admin = admin::find(Auth::id());
        $admin->unreadNotifications()->update(['read_at' => $tanggal]);
        return redirect()->back();
    }
    public function editCategory($id){
        $dataAmbil=DB::select('select * FROM product_categories where id=?', array($id));
        Session::put('idCategory',$id);
        return view('editDataCategory',compact('dataAmbil'));

    }
    public function storeEditCategory(Request $req){
        $data=[
            'category_name'=>$req->category_name
        ];
        $id1=Session::get('idCategory');
        DB::table('product_categories')->where('id', $id1)->update($data);
    }
    public function index(){
        $tahun = CARBON::NOW()->format('Y');
        $reportBulanan = transactions::
        select(DB::raw('MONTHNAME(created_at) as bulan'), DB::raw('COALESCE(SUM(total),0) as pendapatan'))
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->where(DB::raw('YEAR(created_at)'),'=', $tahun)
            ->where('status','success')
            ->get();
        
        $reportTahunan = transactions::
        select(DB::raw('YEAR(created_at) as tahun'), DB::raw('COALESCE(SUM(total),0) as pendapatan'))
            ->groupBy(DB::raw('YEAR(created_at)'))
            ->where('status','success')
            ->get();
            return view('chart',compact("reportBulanan","reportTahunan"));
    }
    public function prosesTransaksi(){
       
        $product1=DB::select('select transactions.`id`,user_id, courier_id, shipping_cost,proof_of_payment, sub_total, status FROM transactions ');
        return view('listTransaksi',compact('product1'));
    }
    public function verifikasi($id){
        $transaksi = transactions::find($id);

        if($transaksi->status == 'unverified'){
            $transaksi->status = 'verified';
        }else if($transaksi->status=='verified'){
            $transaksi->status = 'delivered';
        }
        $transaksi->save();
        return redirect()->back();
        
    }

}
