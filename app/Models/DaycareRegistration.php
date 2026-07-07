<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['owner_name', 'email', 'dog_name', 'drop_off_date', 'time_slot', 'notes'])]
class DaycareRegistration extends Model
{
    protected function casts(): array
    {
        return [
            'drop_off_date' => 'date',
        ];
    }
}
