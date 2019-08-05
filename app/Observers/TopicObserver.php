<?php

namespace App\Observers;

use App\Models\Topic;
use App\Handlers\SlugTranslateHandler;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class TopicObserver
{
    public function creating(Topic $topic)
    {
        //
    }

    public function updating(Topic $topic)
    {
        //
    }
    public function saving(Topic $topic)
    {    
        //xss过滤
        $topic->body = clean($topic->body,'user_topic_body');
        //生成话题摘录
    	$topic->excerpt = make_excerpt($topic->body);

        //如果slug字段无内容，即使用翻译器对 title进行翻译
        if(! $topic->slug)
        {    //1.可以实例化调用
            /*$slurtran = new SlugTranslateHandler;
            $topic->slug = $slurtran->translate($topic->title);*/
            //2.使用laravel的服务容器 app() 允许我们使用 Laravel 服务容器 
            $topic->slug = app(SlugTranslateHandler::class)->translate($topic->title);
        }
    }
}