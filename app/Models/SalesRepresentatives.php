<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class SalesRepresentatives extends Model
{
    use HasFactory;

    protected $table = 'salesrepresentatives';
    public $timestamps = true;
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'telephone',
        'joined_date',
        'working_routes',
        'comments',
    ];



    // public function routes()
    // {
    //     return $this->belongsTo(Routes::class, 'working_routes');
    // }

    // public function getRouteNameAttribute()
    // {
    //     return $this->routes->name;
    // }
}
