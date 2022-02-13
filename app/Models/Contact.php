<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $table = "contacts";
    protected $fillable = [
        "user_id",
        "email_or_phone",
        "first_name",
        "last_name",
        "address",
        "apartment_address",
        "city",
        "country",
        "postal_code",

    ];


    public function user_id()
    {
        return $this->belongsTo(User::class, "user_id");
    }
}
