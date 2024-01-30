<?php

namespace App\Http\Controllers\Excel;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class ExcelController extends Controller
{
    public function openExcelFile($filePath)
    {
        $decodedFilePath = urldecode($filePath);
        $fileFullPath = storage_path('app/public/' . $decodedFilePath);

        if (file_exists($fileFullPath)) {
            $fileName = pathinfo($fileFullPath, PATHINFO_BASENAME);
            $fileMime = File::mimeType($fileFullPath);

            return response()->file($fileFullPath, [
                'Content-Type' => $fileMime,
                'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
            ]);
        } else {
            abort(500);
        }
    }
}
