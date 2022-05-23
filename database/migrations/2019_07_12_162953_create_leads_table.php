<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_assign_id')->nullable($value = true);
            $table->string('user_created_id')->nullable($value = true);
            $table->string('user_updated_id')->nullable($value = true);
            $table->string('client_name')->nullable($value = true);
            $table->string('company_name')->nullable($value = true);
            $table->string('lead_description')->nullable($value = true);
            $table->string('status_id')->nullable($value = true);
            $table->string('lead_source')->nullable($value = true);
            $table->string('vendor_type')->nullable($value = true);
            $table->string('opportunity_amount')->nullable($value = true);
            $table->string('followup_date_time')->nullable($value = true);
            $table->string('disposition')->nullable($value = true);
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
        Schema::dropIfExists('leads');
    }
}
