<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $table ='services';
    protected $fillable = ['id','title','description','sub_description','banner_image','feature_image','call_action_id','created_by','updated_by'];

    public function callAction(){
        return $this->belongsTo('App\Models\CallAction','call_action_id','id');
    }
}