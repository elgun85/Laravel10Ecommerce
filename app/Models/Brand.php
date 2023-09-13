<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    protected $table ='brands';

    protected $fillable=
        [
            'name',
            'slug',
            'category_id',
            'status'
        ];

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id','id');
    }

    public function prod()
    {
        return $this->hasMany(Product::class,'brand','name')->where('status',0);
    }
}
