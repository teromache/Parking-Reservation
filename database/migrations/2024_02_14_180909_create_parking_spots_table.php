<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParkingSpotsTable extends Migration
{
    public function up()
    {
        Schema::create('parking_spots', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('parking_name');
            $table->enum('size', ['small', 'medium', 'large']);
            $table->boolean('availability')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('parking_spots');
    }
}
