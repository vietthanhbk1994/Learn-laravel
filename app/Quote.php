<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    public $table = 'quotes';
    
    public function author() {
        return $this->belongsTo('App\Author');
    }
}
