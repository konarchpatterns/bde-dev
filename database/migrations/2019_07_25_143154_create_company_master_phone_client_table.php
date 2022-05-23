<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyMasterPhoneClientTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_master_phone_client', function (Blueprint $table) {
           $table->increments('id');
           $table->integer('company_id')->unsigned();
           $table->foreign('company_id')->references('id')->on('company_masters')->onDelete('cascade');
           $table->integer('client_phone_id')->unsigned();
           $table->foreign('client_phone_id')->references('id')->on('phone_no_clients')->onDelete('cascade');
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
        Schema::dropIfExists('company_master_phone_client');
    }
}
