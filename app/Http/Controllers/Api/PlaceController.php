<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Repositories\PlaceRepositorie;
use App\Http\Requests\PlaceRequest;
use App\Http\Resources\PlaceResource;
use Illuminate\Http\Request;

class PlaceController extends Controller
{
    protected $repository;

    public function __construct(PlaceRepositorie $repository)
    {
        $this->repository = $repository;
        
    }

    public function index(Request $request) {
        try {
            $filter = isset($request->filter)  ? $request->filter : "";
            $data = $this->repository->ListOrFilterPlace($filter);
            return PlaceResource::collection($data);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'something has gone wrong',
                'message' => $e->getMessage()
            ]);
        }
    }

    public function show(string $slug) {
        try {
            $data = $this->repository->FindBySlugPlace($slug);
            if(empty($data)) {
                return response()->json(['message' => 'Place not found'], 404);
            }
            return new PlaceResource($data);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'something has gone wrong',
                'message' => $e->getMessage()
            ]);
        }
    }

    public function store(PlaceRequest $request) {
        try {
            $create = $this->repository->CreatePlace($request->all());
            if($create) {
                return response()->json(['message' => 'place successfully created'], 201);
            }
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'something has gone wrong',
                'message' => $e->getMessage()
            ]);
        }
    }

    public function update(PlaceRequest $request, string $slug) {
        try {
            $data = $this->repository->FindBySlugPlace($slug);
            if(empty($data)) {
                return response()->json(['message' => 'Place not found'], 404);
            }
            $update = $this->repository->UpdatePlace($request->all(),$data['slug']);
            if($update) {
                return response()->json(['message' => 'place successfully updated'], 201);
            }
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'something has gone wrong',
                'message' => $e->getMessage()
            ]);
        }
    }

    public function destroy(string $slug) {
        try {
            $data = $this->repository->FindBySlugPlace($slug);
            if(empty($data)) {
                return response()->json(['message' => 'Place not found'], 404);
            }
            $update = $this->repository->DestroyPlace($data['slug']);
            if($update) {
                return response()->json(['message' => 'Place deleted successfully'], 201);
            }
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'something has gone wrong',
                'message' => $e->getMessage()
            ]);
        }
    }
}
