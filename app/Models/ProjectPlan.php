<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class ProjectPlan extends Model
{
    use HasFactory, LogsActivity;
    protected $table ='project_plan';
    protected $fillable =['id','name','price','type','description','link','created_by','updated_by'];


    protected static $recordEvents = ['created','updated','deleted'];

    public function getDescriptionForEvent(string $eventName): string
    {
        return "This :subject.name project plan details has been {$eventName} by :causer.name";
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('Project Plan Module')
            ->logOnly( ['name','price','type','description','link'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }
}
