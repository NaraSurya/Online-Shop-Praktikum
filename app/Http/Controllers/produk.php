<?php
namespace App\Http\Controllers;
use File;
use Image;
use DB;
use App\Admin;
use Hash;
use Illuminate\Http\Request;
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
        $data1=[
            'product_name'=>$req->product_name,
            'price'=>$req->price,
            'discount'=>$req->discount,
            'description'=>$req->deskripsi,
            'created_at'=>$tanggal,
            'stock'=>$req->stok,
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
        $tanggal=date("Y-m-d H:i:s");
        $idProduct=Session::get('idProduct'); 
        $idImages=Session::get('idImages');
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
        Session::flush();
        return redirect()->route('admin.Product');
        
    }
}
