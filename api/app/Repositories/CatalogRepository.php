<?php

namespace App\Repositories;

use App\Models\Catalog;

class CatalogRepository extends BaseRepository
{
    public function __construct(Catalog $model) {
        parent::__construct($model);
    }

    public function save(array $data): Catalog
    {
        $catalog = Catalog::create($data);

        if($data['animals']) {
            $catalog->animals()->sync($data['animals']);
        }

        return $catalog;
    }

    public function updateAndSync(Catalog $catalog, array $data)
    {
        if($data['animals']) {
            $catalog->animals()->sync($data['animals']);
        }

        return $catalog->update($data);
    }
}
