<?php

namespace App\Models;
use App\Models\Category;

class Topic extends Model
{
    protected $fillable = ['title', 'body', 'user_id', 'category_id', 'reply_count', 'view_count', 'last_reply_user_id', 'order', 'excerpt', 'slug'];
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
}
