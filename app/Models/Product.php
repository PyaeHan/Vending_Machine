<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Product extends Model
{
    use HasFactory, Sortable;


    protected $fillable = [
        'name',
        'price',
        'available_quantity',
    ];

    public $sortable = [
        'name',
        'price',
        'available_quantity',
    ];
}
