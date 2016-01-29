<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HomeBanner extends Model
{
    protected $fillable = ['image_path', 'show', 'status', 'ordering', 'link_path', 'title'];
}
