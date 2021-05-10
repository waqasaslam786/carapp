<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Brand;

class Carmodal extends Model
{
    use HasFactory;
    protected $table = 'car_models';
    protected $fillable = [
        'name',
        'brand_id',
    ];

    // Has belong to brand
    public function modal(){
        return $this->belongsTo(Brand::class);
    }
}
