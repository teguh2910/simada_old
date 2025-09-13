<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRfqAprsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rfq_aprs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('spec_rm');
            $table->string('periode');
            $table->date('due_date');
            $table->text('id_supplier');
            $table->text('note')->nullable();
            $table->unsignedInteger('pic_id')->nullable();
            $table->string('status')->default('draft');
            $table->string('drawing_file')->nullable();
            $table->string('excel_term_file')->nullable();
            $table->timestamps();

            $table->foreign('pic_id')->references('id')->on('pics')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rfq_aprs');
    }
}
