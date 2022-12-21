<?php

use App\Models\Classroom;
use App\Models\Grade;
use App\Models\My_Parent;
use App\Models\Nationalitie;
use App\Models\Sections;
use App\Models\Type_Bloods;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\Stopwatch\Section;

class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('students')->delete();
        $students = new \App\Models\Student();
        $students->name=['ar'=>'محمد زكريا','en'=>'mohamed zakaria'];
        $students->email = 'Ahmed@yahoo.com';
        $students->password = Hash::make('12345678');
        $students->gender_id = 1;
        $students->nationalitie_id = Nationalitie::all()->unique()->random()->id;
        $students->blood_id =Type_Bloods::all()->unique()->random()->id;
        $students->Date_Birth = date('1995-01-01');
        $students->Grade_id = Grade::all()->unique()->random()->id;
        $students->Classroom_id =Classroom::all()->unique()->random()->id;
        $students->section_id = Sections::all()->unique()->random()->id;
        $students->parent_id = My_Parent::all()->unique()->random()->id;
        $students->academic_year ='2021';
        $students->save();
    }

}
