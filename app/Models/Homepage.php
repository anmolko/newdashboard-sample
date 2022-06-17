<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomePage extends Model
{
    use HasFactory;
    protected $table ='homepages';
    protected $fillable =['id','welcome_heading','welcome_subheading','welcome_description','welcome_image','welcome_side_image','direction_heading','direction_description','direction_list_heading','direction_list_description','direction_list_image','direction_displaying_side_image','direction_container_color','background_heading','background_subheading','background_description','background_image','background_side_image','created_by','updated_by'];
}
