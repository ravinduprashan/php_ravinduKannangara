<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Routes extends Model
{
    use HasFactory;

    protected $table = 'routes';
    public $timestamps = true;
    protected $fillable = [
        'area',
        'name',
        'selected',
    ];

    protected $casts = [
        'selected' => 'boolean',
    ];

    public function salesrepresentatives()
    {
        return $this->hasMany('App\Models\SalesRepresentatives');
    }
}
