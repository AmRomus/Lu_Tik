<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;
use Staudenmeir\LaravelAdjacencyList\Eloquent\Traits\HasAdjacencyList;

class Address extends Model
{
    use HasFactory,HasAdjacencyList, HasRecursiveRelationships;
    protected $fillable=
    [
        'parent_id',
        'unit',
    ];
    public function getCustomPaths()
    {
        return [
            [
                'name' => 'FullAddress',
                'column' => 'unit',
                'separator' => ',',
                'reverse' => true,
            ],
        ];
    }
}
