<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('phone')->comment('Own or Father Phone');
            $table->string('email')->nullable();
            $table->string('father_name')->comment('Father or Husband Name');
            $table->string('nid')->comment('Own or Father NID');
            $table->text('address');
            $table->string('cabin')->nullable()->comment('per day fee count');
            $table->string('bed')->nullable()->comment('per day fee count');
            $table->string('disease');
            $table->integer('sex');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patients');
    }
}
