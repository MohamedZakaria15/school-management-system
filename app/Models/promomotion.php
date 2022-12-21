<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class promomotion extends Model
{
    protected $guarded=[];
    public function student(){
        return $this->belongsTo(Student::class,'student_id');
    }

    public function FG(){
        return $this->belongsTo(Grade::class,'from_grade');

    }
    public function F(){
        return $this->belongsTo(Classroom::class,'from_Classroom');
    }
    public function FS (){
        return $this->belongsTo(Sections::class,'from_section');
    }
    public function tt(){
        return $this->belongsTo(Grade::class,'to_grade');

    }
    public function bb(){
        return $this->belongsTo(Classroom::class,'to_Classroom');
    }
    public function ss (){
        return $this->belongsTo(Sections::class,'to_section');
    }

}
