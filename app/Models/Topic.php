<?php

namespace App\Models;
use App\Models\Category;
use App\Models\User;
use App\Models\Reply;

class Topic extends Model
{
    protected $fillable = ['title', 'body', 'category_id', 'excerpt', 'slug'];
    public function replies()
    {
        return $this->hasMany(Reply::class);
    }
    public function category()
    {
    	return $this->belongsTo(Category::class);
    }
    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function scopeRecent($query)
    {
        //按照创建时间排序
        return $query->orderBy('created_at','desc');
    }
    public function scopeReplied($query)
    {
    	//按照最新回复排序
        return $query->orderBy('updated_at','desc');
    }
    public function scopeWithOrder($query,$order)
    {
         //根据order变量读取使用排序
    	switch($order){
                 case 'recent':
                  $query->recent();
                  break;
                 default:
                  $query->replied();
                  break; 
    	}
    }

    public function link($param=[])
    {
        return route('topics.show',array_merge([$this->id,$this->slug],$param));
    }
}
