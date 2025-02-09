<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToUnitsTable extends Migration
{
    public function up()
    {
        Schema::table('units', function (Blueprint $table) {
            $table->unsignedBigInteger('building_id')->nullable();
            $table->foreign('building_id', 'building_fk_10410748')->references('id')->on('buildings');
            $table->unsignedBigInteger('landlord_id')->nullable();
            $table->foreign('landlord_id', 'landlord_fk_10410750')->references('id')->on('users');
            $table->unsignedBigInteger('tenant_id')->nullable();
            $table->foreign('tenant_id', 'tenant_fk_10410751')->references('id')->on('users');
        });
    }
}
