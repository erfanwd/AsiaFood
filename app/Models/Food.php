<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;
    protected $table="foods";
    protected $fillable=['title','description','stock','history','image','price','category_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
