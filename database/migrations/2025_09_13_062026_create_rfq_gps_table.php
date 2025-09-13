<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRfqGpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rfq_gps', function (Blueprint $table) {
            $table->increments('id');
            $table->text('spec')->nullable();
            $table->decimal('ex_rate', 10, 4)->nullable();
            $table->integer('qty_month')->nullable();
            $table->string('satuan', 50)->nullable();
            $table->text('id_supplier')->nullable(); // Changed to text for JSON storage
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
        Schema::dropIfExists('rfq_gps');
    }
}
