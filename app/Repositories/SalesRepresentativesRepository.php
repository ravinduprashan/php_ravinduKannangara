<?php

namespace App\Repositories;

use App\Models\SalesRepresentatives;

class SalesRepresentativesRepository extends BaseRepository
{
    public function __construct(SalesRepresentatives $model)
    {
        parent::__construct($model); 
    }
}