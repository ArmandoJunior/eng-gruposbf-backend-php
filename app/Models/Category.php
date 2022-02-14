<?php

namespace App\Models;

use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory, Uuid;

    protected $fillable = ['name'];
    protected $casts = ['id' => 'string'];
    public $incrementing = false;

    public function product(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
