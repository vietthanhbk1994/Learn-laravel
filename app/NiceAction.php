<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NiceAction extends Model
{
	public $table = "nice_actions";

    public function logged_actions()
    {
    	return $this->hasMany('App\NiceActionLog');
    }

    public function categories() {
    	return $this->belongsToMany('App\Category', 'categories_nice_actions');
    }
}
