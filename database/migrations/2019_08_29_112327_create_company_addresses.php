<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyAddresses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_id')->unsigned();
            $table->foreign('company_id')->references('id')->on('company_masters')->onDelete('cascade');
            $table->string('house_no')->nullable($value = true);
            $table->string('street_name')->nullable($value = true);
            $table->string('address_line_2')->nullable($value = true);
            $table->string('County')->nullable($value = true);
            $table->string('state')->nullable($value = true);
            $table->string('zip_code')->nullable($value = true);
            $table->string('Country')->nullable($value = true);
            $table->string('time_zone')->nullable($value = true);
            $table->string('fax_no')->nullable($value = true);
            $table->string('type_business')->nullable($value = true);
            $table->string('link_address')->nullable($value = true);
            $table->string('dammy')->nullable($value = true);
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
        Schema::dropIfExists('company_addresses');
    }
}
