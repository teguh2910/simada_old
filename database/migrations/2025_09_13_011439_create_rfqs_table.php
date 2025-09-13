<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRfqsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rfqs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('customer');
            $table->string('produk');
            $table->integer('std_qty');
            $table->date('drawing_time')->nullable();
            $table->date('OTS_Target')->nullable();
            $table->date('OTOP_target')->nullable();
            $table->date('SOP')->nullable();
            $table->string('part_number');
            $table->string('part_name');
            $table->integer('qty_month');
            $table->text('note')->nullable();
            $table->date('due_date');
            $table->string('pic_id');
            $table->string('id_supplier');
            $table->string('drawing_file')->nullable();
            $table->string('excel_term_file')->nullable();
            $table->string('loading_capacity_file')->nullable();
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
        Schema::dropIfExists('rfqs');
    }
}
