<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToAmenityReservationsTable extends Migration
{
    public function up()
    {
        Schema::table('amenity_reservations', function (Blueprint $table) {
            $table->unsignedBigInteger('amenity_id')->nullable();
            $table->foreign('amenity_id', 'amenity_fk_10410879')->references('id')->on('amenities');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_10410880')->references('id')->on('users');
        });
    }
}
