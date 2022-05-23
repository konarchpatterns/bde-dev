<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emails', function (Blueprint $table) {
             $table->increments('id');
             $table->string('from');
             $table->string('to');
             $table->string('subject');
             $table->string('body');
             $table->string('email_id');
             $table->string('read')->nullable($value = true);
             $table->string('send')->nullable($value = true);
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
        Schema::dropIfExists('emails');
    }
}