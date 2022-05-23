<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmailCompanyMasterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_company_master', function (Blueprint $table) {
            $table->increments('id');
           $table->integer('company_id')->unsigned();
           $table->foreign('company_id')->references('id')->on('company_masters')->onDelete('cascade');
           $table->integer('email_id')->unsigned();
            $table->foreign('email_id')->references('id')->on('email_addresses')->onDelete('cascade');
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
        Schema::dropIfExists('email_company_master');
    }
}
