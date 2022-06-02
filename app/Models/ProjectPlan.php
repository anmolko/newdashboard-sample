<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectPlan extends Model
{
    use HasFactory;
    protected $table ='project_plan';
    protected $fillable =['id','name','price','type','description','link','created_by','updated_by'];

}
