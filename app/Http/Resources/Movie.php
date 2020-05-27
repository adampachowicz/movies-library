<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class Movie extends JsonResource
{

    /**
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'title' => $this->title,
            'description' => $this->description,
            'made_in' => $this->made_in,
            'category' => $this->category,
            'updated_at' => Carbon::parse($this->updated_at)->toDateTimeString(),
            'created_at' => Carbon::parse($this->created_at)->toDateTimeLocalString(),
            'id' => $this->id,
            'label' => [
                'name' => $this->file->name,
                'link' => route('files.download', $this->file->id),
            ]
        ];
    }
}
