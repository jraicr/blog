<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    /**
     * Relación uno a muchos inversa de la tabla users
     */
     public function user() {
        return $this->belongsTo(User::class);
     }

      /**
     * Relación uno a muchos inversa de la tabla categories
     */
     public function category() {
        return $this->belongsTo(Category::class);
     }

     /**
      * Relación muchos a muchos de la tabla tags
      */
     public function tags() {
        return $this->belongsToMany(Tag::class);
     }

     /**
      * Relación uno a uno polimórfica con la tabla images
      */
     public function image() {
        return $this->morphOne(Image::class, "imageable");
     }
}
