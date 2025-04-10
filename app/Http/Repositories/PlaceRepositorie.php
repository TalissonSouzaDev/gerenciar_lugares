<?php
namespace App\Http\Repositories;

use App\Models\Places;
use Illuminate\Support\Str;

class PlaceRepositorie {

    protected $places;

    public function __construct(Places $places)
    {
        $this->places = $places;
        
    }

    public function ListOrFilterPlace(string $filter = "") {
        $query = [];
        if (!empty($filter)) {
            $query = $this->places
                            ->where("name","LIKE","%{$filter}%")
                            ->orwhere("city","LIKE","%{$filter}%")
                            ->orwhere("state","LIKE","%{$filter}%")
                            ->get();
            return $query;
        }

        $query = $this->places->all();
        return $query;
    }

    public function FindBySlugPlace(string $slug): Places | array {
        if (empty($slug)) {
            return [];
        }
        $query = $this->places->where("slug", $slug)->first();
        return $query ?? [];
    }

    public function CreatePlace(array $data): bool {
        $slug = Str::slug($data['name']);
        $place = $this->places->create([
            "name" => $data["name"],
            "slug" => $slug,
            "city" => $data["city"],
            "state" => $data["state"]
        ]);
        
        return $place ? true : false;
    }

    public function UpdatePlace(array $data, string $slug): bool {
        $query = $this->places->where("slug",$slug)->first();
        $slug = Str::slug($data['name']);
        $place = $query->update([
            "name" => $data["name"] ?? $query->name,
            "slug" => $slug ?? $query->slug,
            "city" => $data["city"] ?? $query->city,
            "state" => $data["state"] ?? $query->state
        ]);
        return $place ? true : false;
    }

    public function DestroyPlace(string $slug): bool {
        $query = $this->places->where("slug",$slug)->first();
        $query->delete();
        return true;
    }

}