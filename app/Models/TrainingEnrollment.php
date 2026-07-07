<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['training_id', 'owner_name', 'email', 'dog_name', 'phone', 'notes'])]
class TrainingEnrollment extends Model
{
    public function training(): BelongsTo
    {
        return $this->belongsTo(Training::class);
    }
}
