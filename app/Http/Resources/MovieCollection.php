<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class MovieCollection extends ResourceCollection
{

    /**
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'success' => true,
            'message' => 'List movies!',
            'data' => $this->collection,
        ];
    }
}
