<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageView extends Model
{
    protected $fillable = ['page_id', 'page_type', 'views'];

    public function page(): MorphTo{
        return $this->morphTo();
    }
}
