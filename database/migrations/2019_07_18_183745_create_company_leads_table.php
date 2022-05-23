<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_leads', function (Blueprint $table) {
           $table->increments('id');
              $table->integer('company_id')->unsigned();
              $table->foreign('company_id')->references('id')->on('company_masters')->onDelete('cascade');
              $table->integer('lead_id')->unsigned();
              $table->foreign('lead_id')->references('id')->on('leads')->onDelete('cascade');
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
        Schema::dropIfExists('company_leads');
    }
}
