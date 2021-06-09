<?php
namespace Ktran\CE\Helpers;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class FileDrive
{
    private $storageImage;
    const config = [
        'size' => [
            'thumb' => 200,
            'small' => 300,
            'medium' => 800,
        ]
    ];

    // public static function fileManageruploadLocal($files, $path){
    //     $result = [];
    //     foreach($files as $file){
    //         // dd($file->getClientOriginalName());
    //         foreach(self::config['size'] as $dir => $maxSize){
    //             $d = public_path('media/'.$dir.'/'.$path);
    //             if(!file_exists($d)){
    //                 mkdir($d, 0777, true);
    //             }
    //             $img = Image::make($file->getRealPath())->resize($maxSize, $maxSize, function ($constraint) {
    //                 $constraint->aspectRatio();
    //             })->save($d.'/'.$file->getClientOriginalName());
    //         }
    //         $d = public_path('files/'.$path);
    //         $img = Image::make($file->getRealPath())->resize($maxSize, $maxSize, function ($constraint) {
    //             $constraint->aspectRatio();
    //         })->save($d.'/'.$file->getClientOriginalName());
    //         $result[] = [
    //             "isowner" => false,
    //             "ts" => time()*1000,
    //             "mime" => "image/png",
    //             "read" => 1,
    //             "write" => 1,
    //             "size" => "97304",
    //             "hash" => "l1_".rtrim(base64_encode($file->getClientOriginalName()),'='),
    //             "name" => $file->getClientOriginalName(),
    //             "phash" => "l1_".rtrim(base64_encode($path),'='),
    //             "tmb" => 1,
    //             "url" => url("files/".$path.'/'.$file->getClientOriginalName())
    //         ];
    //     }
    //     return $result;
    // }

    public static function fileManageruploadS3($files, $target){
        $result = [];
        $xpath = explode("_", $target);
        $path = base64_decode($xpath[1]);
        foreach($files as $file){
            // $x = Storage::disk('s3')->putFileAs($path, $file, 'public');
            $img = Image::make($file)->stream();
            Storage::disk('s3')->put($path.'/'.$file->getClientOriginalName(), $img->__toString(), 'public');

            $result[] = (object) [
                "mime" => $file->getMimeType(),
                "size" => $file->getSize(),
                "hash" => $xpath[0]."_".rtrim(base64_encode($path."/".$file->getClientOriginalName()),'='),
                "name" => $file->getClientOriginalName(),
                "phash" => $xpath[0]."_".rtrim(base64_encode($path),'='),
                "url" => self::s3Url($path.'/'.$file->getClientOriginalName())
            ];
        }
        return $result;
    }

    public static function s3Url($path){
        return "https://".config('filesystems.disks.s3.bucket').'/s3-'.config('filesystems.disks.s3.region').'.amazonaws.com/'.$path;
    }

}
