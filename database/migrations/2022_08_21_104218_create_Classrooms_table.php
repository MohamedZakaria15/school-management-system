<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassroomsTable extends Migration {

	public function up()
	{
		Schema::create('classrooms', function(Blueprint $table) {

            $table->id();
			$table->string('Name_Class');
			$table->bigInteger('Grade_id')->unsigned();
			$table->timestamps();
		});
	}

	public function down()
	{
        Schema::table('classrooms', function (Blueprint $table) {
            $table->dropForeign(['Grade_id']);
        });
		Schema::drop('Classrooms');
	}
}
