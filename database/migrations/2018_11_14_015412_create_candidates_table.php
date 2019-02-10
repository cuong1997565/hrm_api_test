<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCandidatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidates', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 30);
            $table->string('email', 30)->nullable();
            $table->string('phone', 12)->nullable();
            $table->string('source')->nullable();
            $table->date('date_apply')->nullable();
            $table->datetime('time_interview')->nullable();
            $table->unsignedInteger('plan_id');
            $table->unsignedInteger('position_id');
            $table->unsignedTinyInteger('status')->nullable()->default(0);
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
        Schema::dropIfExists('candidates');
    }
}
