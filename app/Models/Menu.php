<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Menu extends Model
{
    use HasFactory, LogsActivity;
    protected $table ='menus';
    protected $fillable =['name','title','slug','location','content','created_by','updated_by'];

    public function menuitems()
    {
        return $this->hasMany('App\Models\MenuItem');
    }

    protected static $recordEvents = ['created','updated','deleted'];

    public function getDescriptionForEvent(string $eventName): string
    {
        return "This :subject.name menu details has been {$eventName} by :causer.name";
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('Menu Module')
            ->logOnly( ['name','title','slug','location'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }
}

