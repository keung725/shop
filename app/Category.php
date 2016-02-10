<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Category extends Model
{
    protected $table = 'Categories';
    protected $guarded = ['id'];


    public function parent() {

        return $this->hasOne('App\Category', 'id', 'parent_id');

    }

    public function children() {

        return $this->hasMany('App\Category', 'parent_id', 'id')->where('status', 1)->where('show', 1)->orderBy('ordering', 'asc');

    }

    public static function tree($level = 1) {

        return static::with(implode('.', array_fill(0, $level, 'children')))->where('parent_id', '=', NULL)->where('status', 1)->where('show', 1)->orderBy('ordering', 'asc')->get();

    }
}

