<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnimalRequest;
use App\Models\Animal;
use Illuminate\Http\JsonResponse;
use App\Repositories\AnimalRepository;

class AnimalController extends Controller
{
    protected $animalRepository;

    public function __construct(AnimalRepository $animalRepository)
    {
        return $this->animalRepository = $animalRepository;
    }

    public function index(): JsonResponse
    {
        return response()->json($this->animalRepository->all(), 200);
    }

    public function store(AnimalRequest $request): JsonResponse
    {
        if($request->validated())
            return response()->json($this->animalRepository->save($request->getData()), 200);

        return response()->json(["message" => "Validation error!"], 403);
    }

    public function update(AnimalRequest $request, Animal $animal): JsonResponse
    {
        if($request->validated())
            return response()->json($this->animalRepository->update($animal, $request->getData()), 200);

        return response()->json(["message" => "Validation error!"], 403);
    }

    public function destroy(Animal $animal): JsonResponse
    {
        return response()->json($this->animalRepository->delete($animal), 200);
    }
}
