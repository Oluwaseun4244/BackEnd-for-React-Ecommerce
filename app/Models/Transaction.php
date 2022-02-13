<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $table = "transactions";
    protected $fillable = [
        "user_id",
        "product_id",
        "product_qty",
        "product_price",
        "product_total",
        "trans_total",
        "trans_ref",
        "trans_status",
    ];


    public function user_id(){
        return $this->belongsTo(User::class, "user_id");
    }

    public function product_id(){
        return $this->belongsTo(Product::class, "product_id");
    }
    
}
