<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Quest extends Model
{
    use SoftDeletes;
    
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function questLikes(){
        return $this->hasMany(QuestLike::class);
    }

    public function questComments(){
        return $this->hasMany(QuestComment::class);
    }

    public function pageViews(){
        return $this->hasMany(PageView::class);
    }

    public function isLiked(){
        return $this->questLikes()->where('user_id', Auth::user()->id)->exists();
    }

    public function view(): MorphOne{
        return $this->morphOne(PageView::class, 'page');
    }
}
