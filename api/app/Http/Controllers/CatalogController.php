<?php

namespace App\Http\Controllers;

use App\Http\Requests\CatalogRequest;
use App\Models\Catalog;
use Illuminate\Http\JsonResponse;
use App\Repositories\CatalogRepository;

class CatalogController extends Controller
{
    protected $catalogRepository;

    public function __construct(CatalogRepository $catalogRepository)
    {
        return $this->catalogRepository = $catalogRepository;
    }

    public function index(): JsonResponse
    {
        return response()->json($this->catalogRepository->all(), 200);
    }

    public function show($id): JsonResponse
    {
        return response()->json($this->catalogRepository->find($id), 200);
    }

    public function store(CatalogRequest $request): JsonResponse
    {
        if($request->validated())
            return response()->json($this->catalogRepository->save($request->getData()), 200);

        return response()->json(["message" => "Validation error!"], 403);
    }

    public function update(CatalogRequest $request, Catalog $catalog): JsonResponse
    {
        if($request->validated())
            return response()->json($this->catalogRepository->update($catalog, $request->getData()), 200);

        return response()->json(["message" => "Validation error!"], 403);
    }

    public function destroy(Catalog $catalog): JsonResponse
    {
        return response()->json($this->catalogRepository->delete($catalog), 200);
    }
}
