<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImageUpload extends Model
{
    public function user() {
        # Post belongs to some user
        # Define an inverse one-to-many relationship
        return $this->belongsTo('App\User');
    }

    public function lusers() {
        return $this->belongsToMany(User::class);
    }
}
