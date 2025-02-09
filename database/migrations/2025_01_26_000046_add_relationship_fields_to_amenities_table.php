<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToAmenitiesTable extends Migration
{
    public function up()
    {
        Schema::table('amenities', function (Blueprint $table) {
            $table->unsignedBigInteger('building_id')->nullable();
            $table->foreign('building_id', 'building_fk_10410871')->references('id')->on('buildings');
            $table->unsignedBigInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_10410877')->references('id')->on('teams');
        });
    }
}
