<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageViewLog extends Model
{
    protected $fillable = ['page_type', 'page_id', 'ip_address'];
}
