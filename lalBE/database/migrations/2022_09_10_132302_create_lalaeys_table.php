<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLalaeysTable extends Migration
{
    public function up()
    {
        Schema::create('lalaeys', function (Blueprint $table) {
            $table->id();
            $table->string('Name');
            $table->string('Lang');
            $table->string('Type');
            $table->string('Description');
            $table->string('Audio_Path');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('lalaeys');
    }
}
