<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PlaceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->resource['name'] ?? "There is no data",
            'slug' => $this->resource['slug'] ?? "There is no data",
            'city' => $this->resource['city'] ?? "There is no data",
            'state' => $this->resource['state'] ?? "There is no data",
            'created_at' => date("Y-m-d",strtotime($this->resource['created_at'])) ?? "There is no data",
            'updated_at' => date("Y-m-d",strtotime($this->resource['updated_at'])) ?? "There is no data"
        ];
    }
}
