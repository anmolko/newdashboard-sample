<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Career extends Model
{
    use HasFactory, LogsActivity;

    protected $table ='careers';
    protected $fillable =['id','name','slug','position','description','feature_image','type','start_date','end_date','salary','status','meta_title','meta_tags','meta_description','created_by','updated_by'];

    public function jobs(){
        return $this->hasMany('App\Models\ApplyJob','career_id','id');
    }

    protected static $recordEvents = ['created','updated','deleted'];

    public function getDescriptionForEvent(string $eventName): string
    {
        return "This :subject.name career details has been {$eventName} by :causer.name";
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('Career Module')
            ->logOnly( ['name','slug','position','type','end_date','salary','status','meta_title','meta_tags','meta_description'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }
}
