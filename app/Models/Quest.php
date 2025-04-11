<?php
namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Quest extends Model
{
    use SoftDeletes;

    protected $table = 'quests';

    protected $dates = ['deleted_at'];
    public $timestamps = true;

    protected $fillable = [
        'title', 'user_id', 'start_date', 'end_date', 'duration',
        'introduction', 'main_image', 'is_public'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function questLikes(){
        return $this->hasMany(QuestLike::class);
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

    public function questBodies()
    {
        return $this->hasMany(QuestBody::class, 'quest_id', 'id')
                    ->orderBy('day_number')
                    ->orderBy('id');
    }


    //Quest has many quest_comments
    public function Questcomments(){
        return $this->hasMany(QuestComment::class);
    }

    //Quest has many Quest_likes
    public function likes(){
        return $this->hasMany(QuestLike::class);
    }

}