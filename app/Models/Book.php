<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Author;

class Book extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function scopeGetAuthorData($query,$authorIds)
    {
    	if (!empty($authorIds)) {
    		return Author::whereIn('id',$authorIds)->cursor();
    	}else{
    		return [];
    	}
    }

}
