<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('due_date')->nullable();
            $table->string('name')->nullable();
            $table->longText('description')->nullable();
            $table->string('emergency')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
