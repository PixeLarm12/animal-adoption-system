<?php

namespace App\Repositories;

use App\Models\Catalog;

class CatalogRepository extends BaseRepository
{
    public function __construct(Catalog $model) {
        parent::__construct($model);
    }
}
