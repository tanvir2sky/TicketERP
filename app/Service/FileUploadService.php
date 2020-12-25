<?php


namespace App\Service;

use App\Models\File;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;


class FileUploadService
{
    const ROOT_PATH = "uploads/";

    public static function uploadNewFile(Model $model, UploadedFile $file)
    {
        $path = $file->store('files','public_uploads');
        if ($path) {
            $global_file = new File();
            $global_file->location = $path;
            $model->file()->save($global_file);
            return true;
        } else {
            return false;
        }
    }

    public static function deleteFile(File $file)
    {
        Storage::disk('public_uploads')->delete($file->location);
        $file->delete();
        return true;
    }
}
