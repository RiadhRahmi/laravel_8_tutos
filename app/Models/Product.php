<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price'];


    /**
     * relation with category
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }


    public function setCategory($category)
    {
        $this->category()->associate($category)->save();
    }
}
