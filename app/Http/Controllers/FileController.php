<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController
{

    public static function fetchFile(Request $request)
    {
        $request->validate([
            'filename' => 'required',
        ]);

        try {
          $filename = $request->filename;
          return Storage::get("$filename");
        } catch (\Throwable $th) {
          report($th);
          return response('File not found', 404);
        }

    }

    public function getAllFiles()
    {
        return Storage::files('images');
    }
}
