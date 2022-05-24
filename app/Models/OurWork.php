<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OurWork extends Model
{
    use HasFactory;
    protected $table ='our_works';
    protected $fillable =['id','title','image','work_category_id','created_by','updated_by'];

    public function category(){
        return $this->belongsTo('App\Models\OurWorkCategory','work_category_id','id');
    }
}
