<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAmenityReservationsTable extends Migration
{
    public function up()
    {
        Schema::create('amenity_reservations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->datetime('start')->nullable();
            $table->datetime('end');
            $table->string('status');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
