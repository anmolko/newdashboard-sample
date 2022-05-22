<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    use HasFactory;
    protected $table ='menu_items';
    protected $fillable =['title','name','slug','type','target','page_id','blog_id','menu_id','created_by','updated_by'];

    public function menu()
    {
        return $this->belongsTo('App\Models\Page','menu_id', 'id');
    }

}