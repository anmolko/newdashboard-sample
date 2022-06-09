<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;
    
    protected $table ='packages';
    protected $fillable =['id','full_name','email','phone','project_plan_id'];

    public function projectPlan(){
        return $this->belongsTo('App\Models\ProjectPlan','project_plan_id','id');
    }
}
