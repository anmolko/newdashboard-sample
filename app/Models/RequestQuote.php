<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestQuote extends Model
{
    use HasFactory;
    protected $table ='requestquotes';
    protected $fillable =['id','name','phone','email','service_id','status','message'];

    public function service(){
        return $this->belongsTo('App\Models\Service','service_id','id');
    }
}
