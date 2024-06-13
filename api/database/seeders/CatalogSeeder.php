<?php

namespace Database\Seeders;

use App\Models\Catalog;
use Illuminate\Database\Seeder;

class CatalogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $catalogs = [
            [
                'title' => 'Dogs Catalog',
                'description' => 'All dogs.',
            ],
            [
                'title' => 'Cats Catalog',
                'description' => 'All cats',
            ],
        ];

        foreach($catalogs as $key => $catalog) {
            $catalog = Catalog::create([
                'title' => $catalog['title'],
                'description' => $catalog['description'],
            ]);

            $catalog->animals()->attach(['animal_id' => $key == 0 ? 2 : 1]);
        }
    }
}
