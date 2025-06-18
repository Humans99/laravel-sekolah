<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Symfony\Component\HttpFoundation\Response;

class StudentCollection extends ResourceCollection
{
    public function toArray(Request $request): array
    {
        return [
            'status' => Response::HTTP_OK,
            'message' => "Student retrieved successfully",
            'data' => StudentResource::collection($this->collection),
        ];
    }
}
