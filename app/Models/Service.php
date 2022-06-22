<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Service extends Model
{
    use HasFactory, LogsActivity;
    protected $table ='services';
    protected $fillable = ['id','title','slug','description','sub_description','banner_image','feature_image','call_action_id','meta_title','meta_tags','meta_description','created_by','updated_by'];

    public function callAction(){
        return $this->belongsTo('App\Models\CallAction','call_action_id','id');
    }

    protected static $recordEvents = ['created','updated','deleted'];

    public function getDescriptionForEvent(string $eventName): string
    {
        return "This :subject.title service details has been {$eventName} by :causer.name";
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('Service Module')
            ->logOnly( ['title','slug','description','sub_description','banner_image','feature_image','call_action_id','meta_title','meta_tags','meta_description'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }
}
