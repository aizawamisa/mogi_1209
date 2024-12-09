<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Season extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function products()
    {
        return $this->belongsToMany(Product::class,'product_seasons', 'product_id', 'season_id');
    }
}