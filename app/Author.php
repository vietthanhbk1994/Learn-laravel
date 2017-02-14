<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    public $table = 'authors';

    public function quotes() {
        return $this->hasMany('App\Quote');
    }
}
