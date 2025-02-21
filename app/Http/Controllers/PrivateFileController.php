<?php

namespace App\Http\Controllers;

use App\Models\UploadedFile;
use Illuminate\Http\Request;
use Storage;

class PrivateFileController extends Controller
{
    public function get_passport_image($f_name){
        $f=UploadedFile::findOrFail($f_name);
       return Storage::disk('local')->get($f->file_path.'/'.$f->file_name);
    }
    public function get_file($f_name){
        $f=UploadedFile::findOrFail($f_name);
        return Storage::disk('local')->download($f->file_path.'/'.$f->LinkedObject?->id.'/'.$f->file_name);
    }
}
