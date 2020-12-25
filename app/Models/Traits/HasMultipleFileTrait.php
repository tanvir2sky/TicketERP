<?php


namespace App\Models\Traits;


use App\Models\File;

trait HasMultipleFileTrait
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function file()
    {
        return $this->morphMany(File::class, 'fileable');
    }
}
