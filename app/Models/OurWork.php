<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;

class OurWork extends Model
{
    use HasFactory;
    protected $table ='our_works';
    protected $fillable =['id','title','image','work_category_id','created_by','updated_by'];

    public function category(){
        return $this->belongsTo('App\Models\OurWorkCategory','work_category_id','id');
    }

    protected static $recordEvents = ['created','updated','deleted'];

    public function getDescriptionForEvent(string $eventName): string
    {
        return "This :subject.title work details has been {$eventName} by :causer.name";
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('Our Work Module')
            ->logOnly( ['title','work_category_id'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }
}
