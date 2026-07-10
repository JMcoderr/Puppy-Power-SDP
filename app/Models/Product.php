<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

// product in the shop - can be a course or a DIY kit
#[Fillable(['name', 'category', 'description', 'price', 'is_active'])]
class Product extends Model
{
    // cast price to float so arithmetic works correctly
    protected function casts(): array
    {
        return [
            'price' => 'float',
            'is_active' => 'boolean',
        ];
    }
}
