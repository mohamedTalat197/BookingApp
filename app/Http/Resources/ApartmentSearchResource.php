<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ApartmentSearchResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'name'      => $this->name,
            'type'      => $this->apartment_type?->name,
            'size'      => $this->size,
            'beds_list' => $this->bedsList,
            'bathrooms' => $this->bathrooms,
            'facilities' => FacilityResource::collection($this->whenLoaded('facilities')),
        ];

     }
}
