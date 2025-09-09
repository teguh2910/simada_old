<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Createtabletransaksi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id_transaction');
            $table->string('project');
            $table->date('due_date');
            $table->string('supplier');
            $table->string('part_number');
            $table->string('status');
            $table->string('id_document');
            $table->string('file');
            $table->string('revise');
            $table->string('pic');
            $table->string('npk');
            $table->string('is_need');
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
        Schema::dropIfExists('transactions');
    }
}
