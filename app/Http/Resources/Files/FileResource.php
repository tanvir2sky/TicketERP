<?php

namespace App\Http\Resources\Files;

use App\Service\FileUploadService;
use Illuminate\Http\Resources\Json\JsonResource;

class FileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'file_url' => asset(FileUploadService::ROOT_PATH . $this->location)
        ];
    }
}
