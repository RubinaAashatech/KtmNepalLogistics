<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuotationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotations', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->integer('existing_client');
            $table->string('contact_name');
            $table->string('phone');
            $table->string('fax_number');
            $table->string('email');
            $table->string('notification_type');
            $table->string('commodity');
            $table->string('origin_place');
            $table->string('origin_port');
            $table->string('destination');
            $table->string('mode');
            $table->string('inco_terms');
            $table->string('weight_kg');
            $table->string('weight_cubic_meter');
            $table->string('size');
            $table->string('comments');
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
        Schema::dropIfExists('quotations');
    }
}
