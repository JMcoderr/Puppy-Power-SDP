<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

// mass-assignable fields for this model
#[Fillable(['name', 'email', 'password', 'is_admin'])]
// these fields are hidden when the model is serialized to JSON
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    // cast certain fields to specific PHP types automatically
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            // Laravel will hash the password whenever it is set
            'password' => 'hashed',
            // store as tinyint in the DB, cast to true/false in PHP
            'is_admin' => 'boolean',
        ];
    }
}
