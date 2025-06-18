<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'phone' => $this->phone,
            'nis' => $this->nis,
            'bloodType' => $this->bloodType,
            'gender' => $this->gender,
            'user' => new UserResource($this->whenLoaded('user'))
        ];
    }
}
