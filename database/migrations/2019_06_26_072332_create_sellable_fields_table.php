<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSellableFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sellable_fields', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('fieldable_id');
            $table->string('fieldable_type');
            $table->string('name');
            $table->longText('description')->nullable();
            $table->string('input_type')->nullable();
            $table->string('attributes')->nullable();
            $table->string('value')->nullable();

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
        Schema::dropIfExists('sellable_fields');
    }
}
