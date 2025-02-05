<?php

namespace App\Models;

use App\Models\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserGovernmentData extends Model
{
    use HasFactory;

    protected $table = "user_government_datas";
    protected $fillable = [
        "user_id",
        "id_type",
        "id_number",
        "issued_country",
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
