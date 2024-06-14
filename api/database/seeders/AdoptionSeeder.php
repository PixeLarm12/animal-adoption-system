<?php

namespace Database\Seeders;

use App\Models\Adoption;
use Illuminate\Database\Seeder;

class AdoptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adoptions = [
            [
                'animal_id' => 3,
                'person_id' => 1,
                'status' => Adoption::ADOPTION_STATUS_PROCESSING,
                'adoption_date' => '2024-06-13',
            ],
            [
                'animal_id' => 4,
                'person_id' => 2,
                'status' => Adoption::ADOPTION_STATUS_NOT_ACCEPTED,
                'adoption_date' => '2024-06-13',
            ],
        ];

        foreach($adoptions as $adoption) {
            $animal = Adoption::create([
                'animal_id' => $adoption['animal_id'],
                'person_id' => $adoption['person_id'],
                'status' => $adoption['status'],
                'adoption_date' => $adoption['adoption_date'],
            ]);
        }
    }
}
