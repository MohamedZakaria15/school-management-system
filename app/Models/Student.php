<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Student extends Model
{
    use softDeletes;
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
    public function images()
    {
        return $this->morphMany(Image::class,'imageable');

    }
    public function Nationality(){
        return $this->belongsTo(Nationalitie::class,'nationalitie_id');
    }

    public function myparent(){
        return $this->belongsTo(My_Parent::class,'parent_id');
    }
    public function student_account(){
        return $this->hasMany('App\Models\StudentAccount','student_id');
    }


}
