<?php

namespace App\Models;

use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, Uuid;

    protected $fillable = ['name', 'amount'];
    protected $casts = ['id' => 'string'];
    public $incrementing = false;
}
