<?php
namespace Ktran\CE\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Ktran\CE\Helpers\FileDrive;

class CEController extends Controller
{
    public function test(Request $request){
        return view("ce::test");
    }

    public function upload(Request $request){
        $xpath = explode("_", $request->target);
        $path = base64_decode($xpath[1]);
        $files = FileDrive::fileManageruploadS3($request->upload, $request->target);
        $added = [];
        foreach($files as $file){
            $added[] = [
                'size' => $file->size,
                'ts' => time(),
                'read' => 1,
                'write' => 1,
                'mime' => $file->mime,
                'name' => $file->name,
                'hash' => $file->hash,
                'phash' => $file->phash,
                'tmb' => 1,
            ];
        }
        $jsonResponse = [
            'added' => $added,
            'removed' => [
            ],
            'changed' => [
              0 => [
                'size' => 0,
                'ts' => 1623216550,
                'read' => 1,
                'write' => 1,
                'mime' => 'directory',
                'hash' => 'fls2_cHVibGlj',
                'name' => 'public',
                'phash' => 'fls2_Lw',
                'volumeid' => 'fls2_',
                'dirs' => 1,
                'url' => NULL,
              ],
            ],
        ];
        return response()->json($jsonResponse);
    }

    public function editor(Request $request){
        $data=[
            "dir" => "vendor/ktran/ckeditor-elfinder/elfinder",
            "locale" => false,
            "csrf" => true,
            "s3url" => "https://".config('filesystems.disks.s3.bucket').'/s3-'.config('filesystems.disks.s3.region').'.amazonaws.com/'
        ];
        return view('ce::filemanager.editor', $data);
    }
}