<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Topic;
use App\Models\User;

class Category extends Model
{
     protected $fillable = [
            'name','discription',
     ];
     public function topic()
     {
     	return $this->hasMany(Topic::class);
     }
}
