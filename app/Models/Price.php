<?php

namespace App\Models;

use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    use HasFactory, Uuid;

    protected $fillable = ['value', 'currency_code', 'territory'];
    protected $casts = ['id' => 'string'];
    public $incrementing = false;
}
