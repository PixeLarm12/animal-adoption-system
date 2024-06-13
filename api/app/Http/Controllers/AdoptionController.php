<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdoptionRequest;
use App\Models\Adoption;
use App\Repositories\AdoptionRepository;
use Illuminate\Http\JsonResponse;

class AdoptionController extends Controller
{
    protected $adoptionRepository;

    public function __construct(AdoptionRepository $adoptionRepository)
    {
        return $this->adoptionRepository = $adoptionRepository;
    }

    public function index(): JsonResponse
    {
        return response()->json($this->adoptionRepository->all(), 200);
    }

    public function show($id): JsonResponse
    {
        return response()->json($this->adoptionRepository->find($id), 200);
    }

    public function store(AdoptionRequest $request): JsonResponse
    {
        if($request->validated())
            return response()->json($this->adoptionRepository->save($request->getData()), 200);

        return response()->json(["message" => "Validation error!"], 403);
    }

    public function update(AdoptionRequest $request, Adoption $adoption): JsonResponse
    {
        if($request->validated())
            return response()->json($this->adoptionRepository->update($adoption, $request->getData()), 200);

        return response()->json(["message" => "Validation error!"], 403);
    }

    public function destroy(Adoption $adoption): JsonResponse
    {
        return response()->json($this->adoptionRepository->delete($adoption), 200);
    }

    public function getFormSelectOptions(): JsonResponse
    {
        return response()->json($this->adoptionRepository->getFormSelectOptions(), 200);
    }
}
