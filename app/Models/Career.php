<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    use HasFactory;
    protected $table ='careers';
    protected $fillable =['id','name','slug','position','description','feature_image','type','start_date','end_date','salary','status','meta_title','meta_tags','meta_description','created_by','updated_by'];

}
