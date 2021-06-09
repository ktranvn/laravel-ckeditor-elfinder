<?php
namespace Ktran\CE\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CEController extends Controller
{
    public function test(Request $request){
        return view("ce::test");
    }

    public function upload(Request $request){

        $result = FileDrive::fileManageruploadS3($request->upload, $request->target);
        $x = $jayParsedAry = [
            "added" =>$result
        ];
        return response()->json($x);
    }

    public function editor(Request $request){
        $data=[
            "dir" => "packages/barryvdh/elfinder",
            "locale" => false,
            "csrf" => true,
            "s3url" => "https://edumall-test.s3-ap-southeast-1.amazonaws.com/"
        ];
        return view('filemanager.editor', $data);
    }
}