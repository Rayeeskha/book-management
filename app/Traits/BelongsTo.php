<?php 

namespace App\Traits;
use Auth;

trait BelongsTo{

	public function scopePermission($query){
        if (Auth::user()->role_id == 1) {
            return $query;
        }else{
            return $query->where('user_id', Auth::user()->id);
        }
    }

	public function author(){
		return $this->belongsTo('App\Models\Author', 'author_id', 'id');
	}

	public function book(){
		return $this->belongsTo('App\Models\Book', 'book_id', 'id');
	}

	public function user(){
		return $this->belongsTo('App\Models\User', 'user_id', 'id');
	}
}