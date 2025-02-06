<?php

namespace App\Models;

use App\Models\UserGovernmentData;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    protected $table = "users";
    protected $fillable = [
        'name',
        'email',
        'number',
        "gender",
        "dob",
        "nationality",
        "address",
        "email_verified_at",
        "otp",
        "otp_expires_at",
    ];
    protected $hidden = [];

    public function governmentData()
    {
        return $this->hasOne(UserGovernmentData::class);
    }

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'dob' => 'date',
            'otp_expires_at' => 'datetime',
        ];
    }
}
