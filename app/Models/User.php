<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phonenumber',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function businesses(){
        return $this->hasMany(Business::class)->withTrashed()->latest();
    }

    public function businessesVisible(){
        return $this->hasMany(Business::class)->latest();
    }

    public function promotions(){
        return $this->hasMany(Promotion::class)->withTrashed()->latest();
    }

    public function promotionsVisible(){
        return $this->hasMany(Promotion::class)->latest();
    }

    public function businessComments(){
        return $this->hasMany(BusinessComment::class)->withTrashed()->latest();
    }

    public function businessCommentLikes(){
        return $this->hasMany(BusinessCommentLike::class);
    }

    public function businessLikes(){
        return $this->hasMany(BusinessLike::class);
    }

    public function questLikes(){
        return $this->hasMany(QuestLike::class);
    }

    public function spotLikes(){
        return $this->hasMany(SpotLike::class);
    }

    //user has manyu follows (user follows many users)
    public function follows(){
        return $this->hasMany(Follow::class, 'follower_id');
    }

    //user has many followers
    public function followers(){
        return $this->hasMany(Follow::class, 'followed_id');
    }

    //return true if $this user is followed by Auth user
    public function isFollowed(){
        return $this->followers()->where('follower_id', Auth::user()->id)->exists();
    }

    public function following(){
        return $this->belongsToMany(User::class, 'follows', 'follower_id', 'followed_id');
    }

    public function quests(){
        return $this->hasMany(Quest::class)->withTrashed()->latest();
    }

    public function questsVisible(){
        return $this->hasMany(Quest::class)->latest();
    }

    public function spots(){
        return $this->hasMany(Spot::class)->latest();
    }

}
