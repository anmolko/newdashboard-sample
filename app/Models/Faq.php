<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
class Faq extends Model
{
    use HasFactory,LogsActivity;

    protected $table ='faq';
    protected $fillable =['id','name','description','created_by','updated_by'];

    protected static $recordEvents = ['created','updated','deleted'];

    public function getDescriptionForEvent(string $eventName): string
    {
        return "This :subject.name faq details has been {$eventName} by :causer.name";
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('FAQ Module')
            ->logOnly( ['name','description'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }
}
