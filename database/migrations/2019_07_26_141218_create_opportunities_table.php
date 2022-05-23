<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOpportunitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('opportunities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable($value = true);
            $table->string('deletedno')->nullable($value = true);
            $table->string('amount')->nullable($value = true);
            $table->string('stage')->nullable($value = true);
            $table->string('last_stage')->nullable($value = true);
            $table->string('probability')->nullable($value = true);
            $table->string('lead_source')->nullable($value = true);
            $table->string('close_date')->nullable($value = true);
            $table->string('description')->nullable($value = true);
            $table->string('amount_currency')->nullable($value = true);
            $table->string('campaign_id')->nullable($value = true);
            $table->string('created_by_id')->nullable($value = true);
            $table->string('modified_by_id')->nullable($value = true);
            $table->string('assigned_user_id')->nullable($value = true); 
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
        Schema::dropIfExists('opportunities');
    }
}
