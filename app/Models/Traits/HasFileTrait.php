<?php


namespace App\Models\Traits;


use App\Models\File;
use App\Service\FileUploadService;

trait HasFileTrait
{
    public function getFileUrlAttribute()
    {
        return $this->file ? asset(FileUploadService::ROOT_PATH . $this->file->location) : '';
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */

    public function file()
    {
        return $this->morphOne(File::class, 'fileable');
    }
}
