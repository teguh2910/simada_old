<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSurveySuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('survey_suppliers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('link_form');
            $table->string('file')->nullable();
            $table->unsignedInteger('id_supplier')->nullable();
            $table->date('due_date');
            $table->timestamps();

            $table->foreign('id_supplier')->references('id')->on('suppliers')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('survey_suppliers');
    }
}
