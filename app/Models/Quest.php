<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;

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

    //return true if $this post is liked by Auth user
    public function isLiked(){
        return $this->likes()->where('user_id', Auth::user()->id)->exists();
        //$this = post
        //$this->likes() = get all likes of the post
        //where() = within the likes, look for user_id =Auth user
        //exists() = return true if where() finds something
    }
}