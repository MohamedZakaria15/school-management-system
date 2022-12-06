<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Teacher extends Model
{
    use HasTranslations;
    public $translatable = ['Name'];
    protected $guarded=[];

    public function genders(){
        return $this->belongsTo(Gender::class,'Gender_id')->withDefault();

    }
    //علاقة بين المعلمين والتخصاصات لجلب أسم التخصص
    public function specializations(){
        return $this->belongsTo(Specializations::class,'Specialization_id')->withDefault();

    }
    public function Sections()
    {
        return $this->belongsToMany(Sections::class,'teacher_section');
    }


}
