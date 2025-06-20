<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TeacherCollection extends ResourceCollection
{
    public function toArray(Request $request): array
    {
        return [
            'message' => 'Teacher retrieved successfully',
            'data' => TeacherResource::collection($this->collection),
        ];
    }
}
