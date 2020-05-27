<?php

namespace App\Http\Controllers;

use App\File;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class FileController extends Controller
{

    /**
     * @param $id
     * @param File $file
     * @return BinaryFileResponse
     */
    public function download($id, File $file): BinaryFileResponse
    {
        $file = $file::find($id);

        if (empty($file)) {
            abort(404);
        }

        return response()->download(public_path('files/') . $file->name);
    }
}
