<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code', 10);
            $table->string('title', 100);
            $table->unsignedTinyInteger('type');
            $table->string('link')->nullable();
            $table->date('date_sign');
            $table->date('date_effective');
            $table->date('date_expiration')->nullable();
            $table->unsignedInteger('employee_id');
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
        Schema::dropIfExists('contracts');
    }
}
