<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OurWorkCategory extends Model
{
    use HasFactory;
    protected $table ='work_categories';
    protected $fillable =['id','name','slug','created_by','updated_by'];

    public function works(){
        return $this->hasMany('App\Models\OurWork','work_category_id','id');
    }
}
