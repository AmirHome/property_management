<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractsTable extends Migration
{
    public function up()
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('start');
            $table->date('end');
            $table->decimal('rent_amount', 15, 2)->nullable();
            $table->string('status')->nullable();
            $table->string('contract_link')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
