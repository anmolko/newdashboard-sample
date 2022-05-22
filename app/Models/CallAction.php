<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CallAction extends Model
{
    use HasFactory;
    protected $table ='call_actions';
    protected $fillable =['id','name','title','button','link','created_by','updated_by'];

    public function services(){
        return $this->hasMany('App\Models\Service');
    }

}
