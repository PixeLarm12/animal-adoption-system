<?php

namespace Database\Seeders;

use App\Models\Animal;
use App\Models\Adoption;
use Illuminate\Database\Seeder;

class AnimalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $animals = [
            [
                'name' => 'Felix',
                'adoption_status' => Adoption::ADOPTION_STATUS_NOT_STARTED,
                'specie' => Animal::ANIMAL_SPECIE_CAT,
                'sex' => Animal::ANIMAL_SEX_MALE,
                'description' => 'Black and white cute cat.',
                'entry_date' => '2024-06-13',
                'birth_date' => '2022-01-01',
                'vaccines' => [
                    [
                        'title' => 'Rabies vaccine',
                        'date' => '2024-06-13',
                        'next' => '',
                        'description' => '',
                    ],
                    [
                        'title' => 'Leishmaniasis',
                        'date' => '2024-06-13',
                        'next' => '',
                        'description' => '',
                    ]
                ],
                'medical_informations' => [
                    'description' => 'The cat is healthy.'
                ]
            ],
            [
                'name' => 'Bento',
                'adoption_status' => Adoption::ADOPTION_STATUS_NOT_STARTED,
                'specie' => Animal::ANIMAL_SPECIE_DOG,
                'sex' => Animal::ANIMAL_SEX_MALE,
                'description' => 'Funny dog.',
                'entry_date' => '2024-06-13',
                'birth_date' => '2022-02-02',
                'vaccines' => [
                    [
                        'title' => 'Rabies vaccine',
                        'date' => '2024-06-13',
                        'next' => '',
                        'description' => '',
                    ],
                    [
                        'title' => 'Leishmaniasis',
                        'date' => '2024-06-13',
                        'next' => '',
                        'description' => '',
                    ]
                ]
            ],
            [
                'name' => 'Nemo',
                'adoption_status' => Adoption::ADOPTION_STATUS_PROCESSING,
                'specie' => Animal::ANIMAL_SPECIE_FISH,
                'sex' => Animal::ANIMAL_SEX_MALE,
                'description' => 'Trying to finding...',
                'entry_date' => '2024-06-13',
                'birth_date' => '2022-02-02',
            ],
            [
                'name' => 'Godzilla',
                'adoption_status' => Adoption::ADOPTION_STATUS_NOT_ACCEPTED,
                'specie' => Animal::ANIMAL_SPECIE_LIZARD,
                'sex' => Animal::ANIMAL_SEX_FEMALE,
                'description' => 'Caution!!!',
                'entry_date' => '2024-06-13',
                'birth_date' => '2022-02-02',
                'medical_informations' => [
                    'description' => 'The animal is aggressive.'
                ]
            ],
        ];

        foreach($animals as $animal) {
            $animal = Animal::create([
                'name' => $animal['name'],
                'adoption_status' => $animal['adoption_status'],
                'specie' => $animal['specie'],
                'sex' => $animal['sex'],
                'description' => $animal['description'],
                'entry_date' => $animal['entry_date'],
                'birth_date' => $animal['birth_date'],
            ]);

            if($animal['vaccines']) {
                $animal->vaccines()->createMany($animal['vaccines']);
            }

            if($animal['medical_informations']) {
                $animal->medicalInformations()->createMany($animal['medical_informations']);
            }
        }
    }
}
