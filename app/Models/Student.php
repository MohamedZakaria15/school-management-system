<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Student extends Model
{
    use HasTranslations;
    public $translatable=['name'];
    protected $guarded=[];

//علاقة بين الطلاب والانواع لجلب نوع الطالب في جدول الطلاب
    public function gender(){
        return $this->belongsTo(Gender::class,'gender_id');
    }

    public function grade(){
        return $this->belongsTo(Grade::class,'Grade_id');

    }
    public function classroom(){
        return $this->belongsTo(Classroom::class,'Classroom_id');
    }
    public function section(){
        return $this->belongsTo(Sections::class,'section_id');
    }

}
