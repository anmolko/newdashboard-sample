<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Testimonial extends Model
{
    use HasFactory, LogsActivity;
    protected $table ='testimonials';
    protected $fillable = ['id','name','position','rating','description','image','created_by','updated_by'];

    protected static $recordEvents = ['created','updated','deleted'];

    public function getDescriptionForEvent(string $eventName): string
    {
        return "This :subject.name testimonial details has been {$eventName} by :causer.name";
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('Testimonial Module')
            ->logOnly( ['name','position','rating','description','image','created_by','updated_by'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }
}
