<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class HomePage extends Model
{
    use HasFactory, LogsActivity;
    protected $table ='homepages';
    protected $fillable =['id','welcome_heading','welcome_subheading','welcome_description','welcome_image','welcome_side_image','direction_heading','direction_description','direction_list_heading','direction_list_description','direction_list_image','direction_displaying_side_image','direction_container_color','background_heading','background_subheading','background_description','background_image','background_side_image','created_by','updated_by'];


    protected static $recordEvents = ['created','updated','deleted'];

    public function getDescriptionForEvent(string $eventName): string
    {
        return "The homepage details has been {$eventName} by :causer.name";
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('Homepage Module')
            ->logOnly( ['welcome_heading','welcome_subheading','welcome_description','direction_heading','direction_description','direction_list_heading','direction_list_description','direction_container_color','background_heading','background_subheading','background_description'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }
}
