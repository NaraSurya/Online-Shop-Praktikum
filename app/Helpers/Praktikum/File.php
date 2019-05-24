<?php
namespace App\Helpers\Praktikum;
use Illuminate\Support\Facades\Storage;

class File{
    public static function storeImage($request , $folderName){
        if($request->picture){
            $fileName = $request->name.'_image';
            $fileExtension = $request->picture->getClientOriginalExtension();
            $fileNameToStorage = $fileName.'_'.time().'.'.$fileExtension;
            $filePath = $request->picture->storeAs('public/'.$folderName , $fileNameToStorage); 
        } 
        else {
            $fileNameToStorage = 'null.jpg';
        }
        return $fileNameToStorage;
    }

    public static function storeImageWithName($request ,$name, $folderName){
        if($request->picture){
            $fileName = $name.'_image';
            $fileExtension = $request->picture->getClientOriginalExtension();
            $fileNameToStorage = $fileName.'_'.time().'.'.$fileExtension;
            $filePath = $request->picture->storeAs('public/'.$folderName , $fileNameToStorage); 
        } 
        else {
            $fileNameToStorage = 'null.jpg';
        }
        return $fileNameToStorage;
    }

    public static function deleteImage($fileName , $folderName){
        if($fileName != 'null.jpg'){
            Storage::delete(['public/'.$folderName.'/'.$fileName]);
        }
        
    }
    public static function test(){
        return "berhasil";
    }

    
}
?>