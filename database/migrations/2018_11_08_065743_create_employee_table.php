<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code',10);
            $table->string('name');
            $table->string('qualification', 20)->nullable();
            $table->string('address', 150)->nullable();
            $table->string('phone', 12)->unique();
            $table->tinyInteger('gender')->default(0); //female
            $table->date('date_of_birth')->nullable();
            $table->string('avatar')->nullable();
            $table->string('email')->unique();
            $table->unsignedTinyInteger('status')->nullable()->default(1);
            $table->softDeletes();
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
        Schema::dropIfExists('employees');
    }
}
