<?php

use App\Models\Specializations;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpecializationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('specializations')->delete();
        $specializations = [
          ['en'=>'Arabic','ar'=>'عربي'],
            ['en'=>'Science','ar'=>'علوم'],
            ['en'=>'Computer','ar'=>'حاسب ألي'],
            ['en'=>'English','ar'=>'انجليزي'],

        ];
        foreach ($specializations as $s){
            Specializations::create(['Name' => $s]);
        }
    }
}
