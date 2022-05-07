<?php

namespace App\Repositories;

use App\Models\Routes;

class RoutesRepository extends BaseRepository
{
    public function __construct(Routes $model)
    {
        parent::__construct($model); 
    }
}