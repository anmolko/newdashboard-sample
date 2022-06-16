<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplyJob extends Model
{
    use HasFactory;
    protected $table ='applyjobs';
    protected $fillable =['id','name','email','phone','address','message','attachcv','status','career_id'];

    public function career(){
        return $this->belongsTo('App\Models\Career','career_id','id');
    }
}
